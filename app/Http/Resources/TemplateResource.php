<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TemplateResource extends JsonResource
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
            'id' => $this->id,
            'loading' => false,
            'opened' => false,
            'selected' => false,
            'text' => $this->name,
            'disabled' => $this->type,
            'icon' => $this->type ? '' : 'fas fa-sms fa-2x text-danger icon-state-default',
            'children' => Self::collection($this->children)
        ];
    }
}
