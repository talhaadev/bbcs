<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
     protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
    ];

     public function user(){
        return $this->belongsTo(User::class);
    }

     public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
