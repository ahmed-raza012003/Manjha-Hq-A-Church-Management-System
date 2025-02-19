<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'picture',
        'description',
        'user_id',
        'church_name',
    
    ];
    use HasFactory;
    public function members()
    {
        return $this->hasMany(Member::class); // Assuming 'members' table has a 'group_id' foreign key
    }

}
