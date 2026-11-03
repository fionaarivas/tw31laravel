<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_number',
        'member_id',
        'membership_level_id',
        'transaction_type',
        'amount',
        'status',
        'transaction_date',
        'membership_start_date',
        'membership_end_date',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
        'membership_start_date' => 'date',
        'membership_end_date' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function membershipLevel()
    {
        return $this->belongsTo(MembershipLevel::class);
    }

    public function payments()
   {
    return $this->hasMany( Payment::class);
   }

}