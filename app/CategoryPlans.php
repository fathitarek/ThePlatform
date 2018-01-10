<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPlans extends Model
{
        protected $table = 'category_plan';


public function category()
{
    return $this->belongsTo('App\Category');
}


}
