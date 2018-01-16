<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppUsersPosts extends Model
{
    //
    protected $table = 'app_users_posts';
      public function appUser() {
        return $this->belongsTo('App\AppUsers');
    }
}
