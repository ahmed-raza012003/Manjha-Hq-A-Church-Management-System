<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['name','stock', 'asset_id', 'category', 'price', 'status', 'image'  ,'church_name',];

    use HasFactory;
}
