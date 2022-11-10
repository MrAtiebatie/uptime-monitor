<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScanResultResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'query_found' => $this->query_found,
            'query_found_class' => $this->query_found ? 'bg-green-400' : 'bg-red-500',
            'response_body' => $this->response_body,
            'screenshot_data' => $this->screenshot_data,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'created_at_date' => $this->created_at->format('Y-m-d'),
            'created_at_time' => $this->created_at->format('H:i:s'),
        ];
    }
}
