<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactoryCar extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $timestamps = false;
    
    protected $appends = ['name'];

    public function Cars(){
        return $this->hasMany(Car::class);
    }

    public function getNameAttribute(){
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }
}
