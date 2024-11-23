<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;

class TaskTest extends TestCase
{
    private function storeRoute(): string
    {
        return route('task.store');
    }

    public function testTaskStore()
    {
        $project = Project::factory()->create();
        $url = $this->storeRoute();
        $data = Task::factory()->raw([
            Task::PROJECT_ID => $project->id,
        ]);

        $this
            ->postJson($url, $data)
            ->assertCreated();

        $this->assertDatabaseHas('tasks', [
            Task::NAME => $data['name'],
        ]);
    }

    public function testStoreValidateNameIsRequired()
    {
        $url = $this->storeRoute();
        $data = Task::factory()->raw();
        unset($data[Task::NAME]);

        $this
            ->postJson($url, $data)
            ->assertUnprocessable()
            ->assertInvalid([Task::NAME]);
    }

    public function testStoreValidateDueDateIsRequired()
    {
        $url = $this->storeRoute();
        $data = Task::factory()->raw();
        unset($data[Task::DUE_DATE]);

        $this
            ->postJson($url, $data)
            ->assertUnprocessable()
            ->assertInvalid([Task::DUE_DATE]);
    }

    public function testStoreValidateProjectIdIsRequired()
    {
        $url = $this->storeRoute();
        $data = Task::factory()->raw();
        unset($data[Task::PROJECT_ID]);

        $this
            ->postJson($url, $data)
            ->assertUnprocessable()
            ->assertInvalid([Task::PROJECT_ID]);
    }
}
