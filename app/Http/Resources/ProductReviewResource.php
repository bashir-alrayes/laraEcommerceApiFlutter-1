<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id' => (string) $this->id,
            'attributes' => [

                'product_id'=> $this -> product_id,
                'user_id'=> $this -> user_id,
                'review' => $this -> review,
                'rating' => $this -> rating
            ],
        ];
    }
}
