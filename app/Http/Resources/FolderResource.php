<?php

namespace App\Http\Resources;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Folder */
class FolderResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'photos_count' => $this->photoReferences->count(),

            'user' => new UserResource($this->whenLoaded('user')),
            'shared' => new SharedFolderResource($this->whenLoaded('sharedFolder')),
            'photo_references' => PhotoReferenceResource::collection($this->whenLoaded('photoReferences')),
        ];
    }
}
