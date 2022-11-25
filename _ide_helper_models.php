<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\CmsBlog
 *
 * @property-read \App\Models\User|null $author
 * @property-read \App\Models\CmsCategory|null $category
 * @property-read string $description
 * @property-read string $page_url
 * @property-read array $photo
 * @property-read string $pref
 * @property-read string $slug
 * @property-read string $title
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|CmsBlog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsBlog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsBlog query()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsBlog recent(int $count = 5)
 */
	class CmsBlog extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\CmsCategory
 *
 * @property int                                               $id
 * @property string|null                                       $name
 * @property string|null                                       $slug
 * @property int                                               $status
 * @property \Illuminate\Support\Carbon|null                   $created_at
 * @property \Illuminate\Support\Carbon|null                   $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CmsCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CmsBlog[] $blogs
 * @property-read int|null $blogs_count
 * @property-read string $url
 * @method static \Illuminate\Database\Eloquent\Builder|CmsCategory active()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsCategory category($category)
 * @method static \Database\Factories\CmsCategoryFactory factory(...$parameters)
 */
	class CmsCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContactUs
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ContactUs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactUs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactUs query()
 * @mixin \Eloquent
 */
	class ContactUs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Currency
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property string|null $symbol
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Setting[] $setting
 * @property-read int|null $setting_count
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ListedHorsesOrder[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-write mixed $password
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\CustomerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer role($roles, $guard = null)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\HorsePassport
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ListedHorse[] $horses
 * @property-read int|null $horses_count
 * @method static \Illuminate\Database\Eloquent\Builder|HorsePassport active()
 * @method static \Database\Factories\HorsePassportFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|HorsePassport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HorsePassport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HorsePassport query()
 */
	class HorsePassport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\HorseType
 *
 * @property-read object $photo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ListedHorse[] $horses
 * @property-read int|null $horses_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|HorseType active()
 * @method static \Database\Factories\HorseTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|HorseType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HorseType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HorseType query()
 */
	class HorseType extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\ListedHorse
 *
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection $photos
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection $videos
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\ListedHorsesOrder|null $order
 * @property-read \App\Models\HorsePassport|null $passport
 * @property-read \App\Models\HorseType|null $type
 * @method static \Database\Factories\ListedHorseFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ListedHorse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListedHorse newQuery()
 * @method static \Illuminate\Database\Query\Builder|ListedHorse onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ListedHorse query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListedHorse recent(int $count = 5)
 * @method static \Illuminate\Database\Query\Builder|ListedHorse withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ListedHorse withoutTrashed()
 */
	class ListedHorse extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\ListedHorsesOrder
 *
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\ListedHorse|null $listed_horse
 * @method static \Database\Factories\ListedHorsesOrderFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ListedHorsesOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListedHorsesOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListedHorsesOrder query()
 */
	class ListedHorsesOrder extends \Eloquent {}
}

namespace App\Models{
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
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Testimonial
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial query()
 * @mixin \Eloquent
 */
	class Testimonial extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int                             $id
 * @property string|null                     $name
 * @property string                          $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string                          $password
 * @property string|null                     $mobile
 * @property string|null                     $user_type
 * @property string|null                     $image
 * @property int                             $status
 * @property string|null                     $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory            factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserType($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CmsBlog[] $blogs
 * @property-read int|null $blogs_count
 */
	class User extends \Eloquent {}
}

