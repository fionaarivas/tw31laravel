<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fee',
        'validity_period_months',
        'benefits',
        'is_active',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
        'validity_period_months' => 'integer',
        'is_active' => 'boolean',
    ];

    public function membershipTransactions()
    {
        return $this->hasMany(
            MembershipTransaction::class
        );
    }
}