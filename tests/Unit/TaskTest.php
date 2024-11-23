<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;

class TaskTest extends TestCase
{

    public function testBelongsToProject(): void
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create([
            Task::PROJECT_ID => $project->id,
        ]);

        $this->assertTrue($task->project->is($project));
    }
}
