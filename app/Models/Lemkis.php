<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lapin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lemkis extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function lapin(){
        return $this->belongsTo(Lapin::class);
    }

}
