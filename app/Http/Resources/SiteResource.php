<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SiteResource extends JsonResource
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
            'id' => $this->id,
            'last_scan' => new ScanResultResource($this->whenLoaded('last_scan_result')),
            'url' => $this->url,
            'search_query' => $this->search_query,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'show_url' => route('sites.show', $this->resource),
        ];
    }
}
