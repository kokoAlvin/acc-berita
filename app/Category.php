<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function blogs(){
        return $this->hasMany(Blog::class); 
    }
}
