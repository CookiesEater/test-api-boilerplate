<?php

namespace App\Api\V1\Builders;

/**
 * Builder for PostRepository.
 */
class PostBuilder extends BaseBuilder
{
    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->attributes['id'] = $id;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->attributes['title'] = $title;

        return $this;
    }

    /**
     * @param string $shortDescription
     *
     * @return $this
     */
    public function setShortDescription(string $shortDescription): self
    {
        $this->attributes['short_description'] = $shortDescription;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->attributes['description'] = $description;

        return $this;
    }
}
