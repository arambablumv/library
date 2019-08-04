<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table='authors';
    public $timestamps=false;
    protected $hidden=['pivot'];

    public function library(){
        return $this->belongsToMany(Library::class,'library_authors','author_id','library_id');
    }

}
