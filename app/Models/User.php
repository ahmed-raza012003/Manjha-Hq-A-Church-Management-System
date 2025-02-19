<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, HasFactory, Notifiable;

    protected $fillable = [
        'church_name',
        'first_name',
        'email',
        'password',
        'google_id',
        'facebook_id',
            'stripe_customer_id',
            'stripe_subscription_id',
            'package_id',
            'subscription_ends_at',
        
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship with Subscription.
     */
    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'user_id')->where('status', 'active');
    }

    /**
     * Relationship to fetch the package through Subscription.
     */
    public function package()
    {
        return $this->hasOneThrough(
            Package::class,   // Final target model
            Subscription::class, // Intermediate model
            'user_id',    // Foreign key on Subscription (refers to User)
            'id',         // Primary key on Package
            'id',         // Primary key on User
            'package_id'  // Foreign key on Subscription (refers to Package)
        );
    }

    /**
     * Check if the user has an active subscription.
     */
    public function hasActiveSubscription()
    {
        return $this->subscription()->exists();
    }

    /**
     * Check if the package includes a specific feature.
     */
    public function hasFeature($feature)
    {
        return $this->package && isset($this->package->$feature) ? $this->package->$feature : false;
    }

    /**
     * Get the limit of a feature from the package (e.g., max members, max groups).
     */
    public function maxLimit($feature)
    {
        return $this->package ? $this->package->$feature : 0;
    }
}
