<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
{
    /**
     * Transform resource into array
     * 
     * @param \Illuminate\Http\Request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request):array {
        return [
            // "base_color"=> $this->base_color,
            // "original_hue"=>$this->original_hue,
            // "close_hue_name"=>$this->close_hue_name,
            // "close_hue"=>$this->close_hue,
            // "hsv"=>$this->hsv,
            "id"=>$this->id
        ];
    }
}