<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $timestamps = false;

    protected $appends = ['name'];

    public function factoryCar()
    {
        return $this->belongsTo(FactoryCar::class);
    }//end of factory Car

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function getNameAttribute(){
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

}
