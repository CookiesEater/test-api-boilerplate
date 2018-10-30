<?php

namespace App\Api\V1\Finders;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface FinderInterface
{
    /**
     * Retrieving collection of all elements.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Retrieving one model.
     *
     * @return Model
     */
    public function one(): Model;

    /**
     * Retrieve pagination object.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage): LengthAwarePaginator;
}
