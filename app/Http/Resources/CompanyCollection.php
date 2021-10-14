<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\CompanyResource;
use Symfony\Component\HttpFoundation\Response;

class CompanyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => CompanyResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
               'length' => $this->collection->count(),
               'success' => true,
               'code' => Response::HTTP_OK,
               'message' => "Companies retrieve successfully"
            ]
        ];
    }
}
