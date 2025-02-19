<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'can_manage_members',
        'max_members',
        'max_groups',
    ];

    // Check if the package allows unlimited members
    public function isUnlimitedMembers()
    {
        return is_null($this->max_members);
    }

    // Check if the package allows unlimited groups
    public function isUnlimitedGroups()
    {
        return is_null($this->max_groups);
    }

    // Relationship with Users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
