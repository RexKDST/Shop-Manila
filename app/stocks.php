<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stocks extends Model
{
    protected $table = 'stock_info';

    public function categories() {

        return $this->belongsToMany('Category', 'pro_cat');
}
}
