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
}
