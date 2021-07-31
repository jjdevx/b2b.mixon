<?php

namespace Modules\Account\Http\Resources;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\User */
class UserCollection extends ResourceCollection
{
    public function toArray($request = null): array
    {
        $array = [
            'collection' => $this->collection,
        ];

        if ($this->resource instanceof LengthAwarePaginator) {
            $array['total'] = $this->resource->total();
            $array['lastPage'] = $this->resource->lastPage();
            $array['perPage'] = (int)$this->resource->perPage();
            $array['currentPage'] = $this->resource->currentPage();
        }

        return $array;
    }
}
