<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [

        'ID'=> $this->id,
        'title'=> $this->title,
        'description'=> $this->description,
        'phone'=> $this->phone,
        'created_at'=> $this->created_at->format('Y-m-d ')
 

        ];
    }
}
