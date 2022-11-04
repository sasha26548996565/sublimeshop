<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'address_line_2' => $this->address_2,
            'phone' => $this->phone,
            'country' => new CountryResource($this->country),
            'city' => new CityResource($this->city),
            'province' => new ProvinceResource($this->province),
            'delivery' => $this->delivery,
            'zipcode' => $this->zipcode,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'products' => ProductResource::collection($this->products),
            'coupon' => new CouponResource($this->coupon),
        ];
    }
}
