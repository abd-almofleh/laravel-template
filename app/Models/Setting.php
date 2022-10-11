<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string|null $website_title
 * @property string|null $website_logo_dark
 * @property string|null $website_logo_light
 * @property string|null $website_logo_small
 * @property string|null $website_favicon
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_tag
 * @property int|null $currency_id
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $linkedin
 * @property string|null $instagram
 * @property string|null $github
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency|null $currency
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereGithub($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMetaTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereWebsiteFavicon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereWebsiteLogoDark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereWebsiteLogoLight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereWebsiteLogoSmall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereWebsiteTitle($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    use HasFactory, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_title',
        'website_logo_dark',
        'website_logo_light',
        'website_logo_small',
        'website_favicon',
        'meta_title',
        'meta_description',
        'meta_tag',
        'currency_id',
        'address',
        'phone',
        'email',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'github',
    ];

    public function currency()
    {
        return $this->belongsTo(currency::class, 'currency_id');
    }

}
