<?php

namespace App\Http\Resources;

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
            'id'=>$this->id,
            'user'=>$this->user->name,
            'title'=>$this->title,
            'description'=>$this->description,
            'status'=>$this->isCompleted?'done':'pending',
            'created_at'=>$this->created_at,
        ];
    }
}
