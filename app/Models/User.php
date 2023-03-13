<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, Billable;
    use HasRoleAndPermission;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'about_us_source', 'status',
        'phone', 'manage_income_property', 'interest', 'contact_timing', 'provider',
        'provider_user_id', 'photo', 'user_id', 'trial_ends_at', 'card_last_four', 'card_brand',
        'stripe_id', 'photo', 'plan_id', 'member_automated_id', 'date_of_birth', 'social_security_number', 'street', 'city', 'state', 'zip','verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function statuses()
    {
        return $this->belongsTo('App\Models\Status', 'status');
    }

    public function verifyUser()
    {
        return $this->hasOne('App\Models\VerifyUser');
    }

    public function referral()
    {
        return $this->hasMany('App\Referral', 'user_id');
    }

    public function plan()
    {
        return $this->hasOne('App\Models\Plan', 'id', 'plan_id');
    }

    public function NewVentureListing()
    {
        return $this->hasOne('App\Models\CurrentVentureListing', 'user_id');
    }

    public function ventures()
    {
        return $this->belongsToMany('App\Models\Venture', 'users_venture_listings', 'user_id', 'venture_id');
    }

    public function ventureListings()
    {
        return $this->belongsToMany('App\Models\VentureListing', 'users_venture_listings');
    }

    public function role()
    {
        return $this->hasOne('App\Models\UserRole');
    }

    public function sellingListings()
    {
        return $this->belongsToMany('App\Models\VentureListing', 'user_venture_listing_selling', 'user_id', 'venture_listing_id')->withPivot('price', 'description', 'ownership_percent');
    }

    public function buyNowListingRequests()
    {
        return $this->hasMany('App\Models\BuyNow', 'user_id');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer', 'user_id');
    }
}
