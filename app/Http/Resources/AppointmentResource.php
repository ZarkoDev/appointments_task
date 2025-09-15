<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        # We can use whenLoaded for relationship but then we can have issue if we forget to load them from some route if it's big project
        return [
            'id' => $this->id,
            'user' => UserResource::make($this->user),
            'notification_method' => NotificationMethodResource::make($this->notification_method),
            'time' => optional($this->time)->format('d-m-Y H:i'),
            'description' => $this->description,
            'notified_at' => optional($this->notified_at)->format('d-m-Y H:i'),
            'created_at' => optional($this->created_at)->format('d-m-Y H:i'),
            'updated_at' => optional($this->updated_at)->format('d-m-Y H:i'),
        ];
    }
}
