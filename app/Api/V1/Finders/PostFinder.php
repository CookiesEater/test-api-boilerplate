<?php

namespace App\Api\V1\Finders;

/**
 * Finder for Post repository.
 */
class PostFinder extends BaseFinder
{
    /**
     * Condition by ids.
     *
     * @param array $ids
     *
     * @return $this
     */
    public function byIds(array $ids): self
    {
        $this->builder->whereIn('id', $ids);

        return $this;
    }

    /**
     * Condition by created at >= date.
     *
     * @param \DateTime $dateTime
     *
     * @return PostFinder
     */
    public function byCreatedAtFrom(\DateTime $dateTime): self
    {
        $this->builder->where('created_at', $dateTime->format(\DateTime::ATOM), '>=');

        return $this;
    }

    /**
     * Condition by created at <= date.
     *
     * @param \DateTime $dateTime
     *
     * @return PostFinder
     */
    public function byCreatedAtTo(\DateTime $dateTime): self
    {
        $this->builder->where('created_at', $dateTime->format(\DateTime::ATOM), '<=');

        return $this;
    }
}
