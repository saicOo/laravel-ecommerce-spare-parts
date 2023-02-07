<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['name','description'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }//end of brand
    public function category()
    {
        return $this->belongsTo(Category::class);
    }//end of category
    public function car()
    {
        return $this->belongsTo(Car::class);
    }//end of Car

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order')->withPivot(['quantity','price']);

    }//end of order

    public function getNameAttribute(){
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getDescriptionAttribute(){
        return app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }
}
