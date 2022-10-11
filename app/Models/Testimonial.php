<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Testimonial
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial query()
 * @mixin \Eloquent
 */
class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'position',
        'description',
        'status',
    ];
}
