<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'member_id',
        'task_title',
        'description',
        'completed',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}