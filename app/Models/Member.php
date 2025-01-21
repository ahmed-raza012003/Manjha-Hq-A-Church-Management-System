<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'nick_name',
        'picture',
        'gender',
        'date_of_birth',
        'group_id',
        'baptism_date',
        'member_status',
        'full_address',
        'city',
        'email',
        'phone_number',
        'job_title',
        'employer',
        'is_draft',
    ];

    /**
     * Scope a query to only include drafts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDrafts($query)
    {
        return $query->where('is_draft', true);
    }

    /**
     * Scope a query to only include finalized (non-draft) members.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFinalized($query)
    {
        return $query->where('is_draft', false);
    }


    public function group()
    {
        return $this->belongsTo(Group::class); // Assuming 'members' table has a 'group_id' foreign key
    }
}
