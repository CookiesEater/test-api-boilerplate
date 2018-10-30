<?php

namespace App\Api\V1\Builders;

interface BuilderInterface
{
    /**
     * Returns all attributes.
     *
     * @return array
     */
    public function getAttributes(): array;
}
