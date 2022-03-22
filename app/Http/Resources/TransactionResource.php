<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'buyer'          => $this->buyer,
            'price_per_kilo' => $this->price_per_kilo,
            'total_price'    => $this->total_price,
            'weight'         => $this->weight,
        ];
    }
}
