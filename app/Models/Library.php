<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Library extends Model
{
    protected $table='libraries';

    public function author(){
        return $this->belongsToMany(Author::class,'library_authors','library_id','author_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

}
