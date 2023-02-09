<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['name'];

    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function getNameAttribute(){
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }
}
