<?php

namespace App\Api\V1\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property Carbon $updated_at
 * @property Carbon $created_at
 */
class Post extends Model
{
    /**
     * {inheritdoc}
     */
    public $incrementing = false;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'id',
        'title',
        'short_description',
        'description',
    ];
}
