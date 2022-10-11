<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


/**
 * App\Models\CmsPage
 *
 * @property int $id
 * @property string|null $title
 * @property string $slug
 * @property string|null $description
 * @property int|null $cms_category_id
 * @property int $status
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CmsCategory|null $cmscategory
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage query()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereCmsCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CmsPage extends Model
{
    use HasFactory, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'cms_category_id',
        'description',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function cmscategory()
    {
        return $this->belongsTo(CmsCategory::class,'cms_category_id');
    }

}
