<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLinked extends Model
{
    protected $table = 'product_links';
    protected $fillable=['code','petmart','emag','pentruanimale','zooplus'];
}
