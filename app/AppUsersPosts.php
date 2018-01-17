<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppUsersPosts extends Model
{
    //
    protected $table = 'app_users_posts';
    protected $fillable = ['message', 'picture', 'created_time', 'category_id', 'app_user_id','id'];

      public function appUser() {
        return $this->belongsTo('App\AppUsers');
    }
}
