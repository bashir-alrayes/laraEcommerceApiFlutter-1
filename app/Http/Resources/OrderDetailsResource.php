<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [

            'id' => (string) $this->id,
            'attributes' => [
                'order_id' => $this->order_id,
                'product_id' => $this->product_id,
                'quantity' => $this->quantity,
                'price' => $this->price


            ],
        ];
    }
}
