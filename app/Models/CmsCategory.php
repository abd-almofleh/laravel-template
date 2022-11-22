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
    'name_en',
    'name_ar',
    'status',
  ];

  public function getNameAttribute(): string
  {
    $name = null;
    switch(app()->getLocale()) {
      case 'en':
        $name = $this->name_en;
        break;
      case 'ar':
        $name = $this->name_ar;
        break;
      default:
        $name = $this->name_en;
    }
    return $name;
  }

  public function getUrlAttribute(): string
  {
    return route('blogs.list', ['category'=> $this->name]);
  }

  public function blogs()
  {
    return $this->hasMany(CmsBlog::class, 'cms_category_id');
  }

  /**
   * Scope a query to only include active categories.
   *
   * @param \Illuminate\Database\Eloquent\Builder $query
   */
  public function scopeActive($query)
  {
    $query->where('status', 1);
  }

  /**
   * Scope a query to only include active categories.
   *
   * @param \Illuminate\Database\Eloquent\Builder $query
   */
  public function scopeCategory($query, $category)
  {
    $field_name = '';
    switch(app()->getLocale()) {
      case 'en':
        $field_name = 'name_en';
        break;
      case 'ar':
        $field_name = 'name_ar';
        break;
      default:
        $field_name = 'name_en';
    }
    $query->where($field_name, 'LIKE', $category);
  }
}
