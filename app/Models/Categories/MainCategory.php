<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category'
    ];

    public function subCategories(){
        return $this->hasMany('App\Models\Categories\SubCategory');// リレーションの定義
    }

    public function mainTosubCategory($category_id){
        return MainCategory::with('subCategories')->find($category_id)->subCategories();
    }

}
