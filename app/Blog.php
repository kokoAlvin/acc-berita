<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $table = 'blog';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function blogs(){
        return $this->hasMany(Blog::class,'user_id','id'); 
    }
}
