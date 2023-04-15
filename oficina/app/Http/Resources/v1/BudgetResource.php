<?php

namespace App\Http\Resources\v1;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BudgetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $seller = Seller::query()->where('id', $this->seller_id)->first();
        return [
            'id' => $this->id,
            'client' => $this->client,
            'price' => $this->price,
            'description' => $this->description,
            'seller' => $seller->name,
            'seller_id' => $this->seller_id,
            'created_day' => $this->created_at->format('d-m-Y'),
            'created_hours' => $this->created_at->format('H:m'),
        ];
    }
}
