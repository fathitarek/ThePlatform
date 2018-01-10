<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';

public function CategoryPlans()
{
    return $this->hasMany('App\CategoryPlans');
}



}
