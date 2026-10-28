<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'membership_number',
        'name',
        'email',
        'phone_number',
        'address',
        'membership_category_id',
        'membership_level_id',
        'status',
    ];

    public function membershipCategory()
    {
        return $this->belongsTo(MembershipCategory::class);
    }

    public function membershipLevel()
    {
        return $this->belongsTo(MembershipLevel::class);
    }
}
