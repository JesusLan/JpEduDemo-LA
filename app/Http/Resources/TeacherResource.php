<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TeacherResource extends Resource
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
            'name' => $this->name,
            'email' => $this->email,
            'bind_line' => $this->socialite()->where('oauth_type', 'line')->where('provider', 'teachers')->count() ? true : false,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
