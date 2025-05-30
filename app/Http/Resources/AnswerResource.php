<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
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
            'body' => $this->body,
            'user' => UserResource::make($this->user),
            'votes_count' => $this->votes_count,
            'is_best' => $this->isBest(), // fungsi isBest() untuk mengecek apakah answer ini adalah answer terbaik dari question ini
            'question_id' => $this->question_id, // fungsi question_ id untuk pertanyaan yang dijawab
            'created_at' => DateRTimeResource::make($this->created_at),
            'can_be' => [
                'updated' => $request->user() && $request->user()->can('update', $this->resource), // update dari controller AnswerController
                'deleted' => $request->user() && $request->user()->can('delete', $this->resource), // delete dari controller AnswerController
            ],
        ];
    }
}
