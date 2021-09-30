<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
   protected $fillable = ['content'];
    
    public function get_micropostno_user(){
        return $this->belongsTo(User::class);
    }
    
    public function get_favorite_users()
    {
        return $this->belongsToMany(Micropost::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }
}
