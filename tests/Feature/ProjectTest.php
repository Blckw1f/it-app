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
    private function indexRoute(): string
    {
        return route('project.index');
    }
    private function showRoute($id): string
    {
        return route('project.show', $id);
    }
    private function updateRoute($id): string
    {
        return route('project.update', $id);
    }
    private function deleteRoute($id): string
    {
        return route('project.delete', $id);
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

    public function testProjectIndex()
    {
        $current = Project::all()->count();
        $random = rand(min: 1, max: 20);
        $url = $this->indexRoute();

        Project::factory()->count($random)->create();

        $this
            ->getJson($url)
            ->assertOk()
            ->assertJsonCount($random + $current, 'data');
    }

    public function testProjectShow()
    {
        Project::factory()->count(10)->create();
        $id = rand(min: 1, max: 9);
        $url = $this->showRoute($id);

        $this
            ->getJson($url)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $id,
                ]
            ]);
    }

    public function testProjectUpdate()
    {
        $project = Project::factory()->create();
        $url = $this->updateRoute($project->id);

        $data = $project->toArray();
        $data[Project::NAME] = 'test';

        $this
            ->putJson($url, $data)
            ->assertOk();

        $this->assertDatabaseHas('projects', [
            Project::NAME => $data['name'],
        ]);
    }

    public function testUpdateValidateNameIsRequired()
    {
        $project = Project::factory()->create();
        $url = $this->updateRoute($project->id);

        $data = $project->toArray();
        unset($data[Project::NAME]);

        $this
            ->putJson($url, $data)
            ->assertUnprocessable()
            ->assertInvalid([Project::NAME]);
    }

    public function testProjectDelete()
    {
        $project = Project::factory()->create();

        $url = $this->deleteRoute($project->id);

        $this
            ->deleteJson($url)
            ->assertSuccessful();

        $this->assertDatabaseMissing('projects', [
            Project::ID => $project->id,
        ]);
    }
}
