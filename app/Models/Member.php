<?php

namespace App\Models;

use App\Models\User;
use App\Models\Task;
use App\Models\MembershipCategory;
use App\Models\MembershipLevel;
use App\Models\MembershipTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'membership_number',
        'name',
        'email',
        'phone_number',
        'address',
        'latitude',
        'longitude',
        'membership_category_id',
        'membership_level_id',
        'status',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function membershipCategory()
    {
        return $this->belongsTo(MembershipCategory::class);
    }

    public function membershipLevel()
    {
        return $this->belongsTo(MembershipLevel::class);
    }

    public function membershipTransactions()
    {
        return $this->hasMany(MembershipTransaction::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}