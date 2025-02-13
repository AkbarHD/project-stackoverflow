<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'votes_count' => $this->votes_count,
            'answers_count' => $this->answers_count,
            'views_count' => $this->views_count,
            'summary' => str($this->body)->limit(250),
            'user' => UserResource::make($this->user), // kayanya krn ini akan merujuk ke model user karena dalam model user ada method avatarUrl
            'created_at' => DateRTimeResource::make($this->created_at),
            'updated_at' => DateRTimeResource::make($this->updated_at),
        ];
    }
}
