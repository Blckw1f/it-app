<?php

namespace Tests\Feature;

use App\Models\Project;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    private function storeRoute(): string
    {
        return route('project.store');
    }

    public function testProjectStore()
    {
        $url = $this->storeRoute();
        $data = Project::factory()->raw();

        $this
            ->postJson($url, $data)
            ->assertCreated();

        $this->assertDatabaseHas('projects', [
            Project::NAME => $data['name'],
        ]);
    }

    public function testStoreValidateNameIsRequired()
    {
        $url = $this->storeRoute();
        $data = Project::factory()->raw();
        unset($data[Project::NAME]);

        $this
            ->postJson($url, $data)
            ->assertUnprocessable()
            ->assertInvalid([Project::NAME]);
    }
}
