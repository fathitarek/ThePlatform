<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AppUsers extends Authenticatable {

    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;
    protected $table = 'app_users';

    public function appUserPosts() {
        return $this->hasMany('App\AppUsersPosts');
    }

}
