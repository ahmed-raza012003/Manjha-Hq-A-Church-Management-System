<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{

   
    protected $fillable = [
        'member_id', 
        'payment_method', 
        'date', 
        'amount', 
        'fund', 
        'batch_id'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }


    use HasFactory;
}
