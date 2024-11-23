<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    public function testHasManyTasks(): void
    {
        $project = Project::factory()->create();

        $this->assertEmpty($project->tasks);

        $task = Task::factory()->create([
           Task::PROJECT_ID => $project->id,
        ]);

        $collection = $project->tasks()->get();
        $this->assertTrue($collection->contains($task));
    }
}
