<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lemkis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lapin extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function lemkis(){
        return $this->hasOne(Lemkis::class);
    }

}
