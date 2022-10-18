<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CmsCategory
 *
 * @property        int                                               $id
 * @property        string|null                                       $name
 * @property        string|null                                       $slug
 * @property        int                                               $status
 * @property        \Illuminate\Support\Carbon|null                   $created_at
 * @property        \Illuminate\Support\Carbon|null                   $updated_at
 * @method   static \Illuminate\Database\Eloquent\Builder|CmsCategory newModelQuery()
 * @method   static \Illuminate\Database\Eloquent\Builder|CmsCategory newQuery()
 * @method   static \Illuminate\Database\Eloquent\Builder|CmsCategory query()
 * @method   static \Illuminate\Database\Eloquent\Builder|CmsCategory whereCreatedAt($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|CmsCategory whereId($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|CmsCategory whereName($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|CmsCategory whereSlug($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|CmsCategory whereStatus($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|CmsCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CmsCategory extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'status',
  ];

  public function blogs()
  {
    return $this->hasMany(CmsBlog::class, 'cms_category_id');
  }
}
