<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title" => $this->title,
            "description" => $this->description,
            "year" => $this->year,
            "rank" => $this->rank,
            "genres" => new GenreCollection($this->genres),
            "crews" => new MovieCrewCollection($this->crews),
        ];
    }
}
