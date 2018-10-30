<?php

namespace App\Http\Requests;

class Request extends \Illuminate\Http\Request
{
    /**
     * {@inheritdoc}
     */
    public function expectsJson(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function wantsJson(): bool
    {
        return true;
    }
}
