<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'isbn' => $this->isbn,
            'total_pages' => (int) $this->total_pages,
            'published_at' => $this->published_at,
            'price' => (float) $this->price,
            'publisher' => $this->whenLoaded('publisher', new PublisherResource($this->publisher)),
            'authors' => $this->whenLoaded('authors', AuthorResource::collection($this->authors)),
            'sections' => $this->whenLoaded('bookSections', BookSectionResource::collection($this->bookSections)),
            'pdf' => $this->pdf,
            'image' => $this->image,
        ];
    }
}
