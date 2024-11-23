<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $projects = Project::all();
        return ProjectResource::collection($projects->load('tasks'));
    }

    public function store(ProjectStoreRequest $request): ProjectResource
    {
        $project = Project::create($request->validated());

        return new ProjectResource($project);
    }

    public function show(Project $project): ProjectResource
    {
        return new ProjectResource($project->load('tasks'));
    }

    public function update(ProjectStoreRequest $request, Project $project): ProjectResource
    {
        $project->update($request->validated());

        return new ProjectResource($project);
    }

    public function destroy(Project $project): ProjectResource
    {
        $project->delete();

        return new ProjectResource($project);
    }
}
