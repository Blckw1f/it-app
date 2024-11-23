<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->{Task::ID},
            'name' => $this->{Task::NAME},
            'due_date' => $this->{Task::DUE_DATE},
            'project' => new ProjectResource($this->whenLoaded('project')),
        ];
    }
}
