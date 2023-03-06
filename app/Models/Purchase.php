<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['status','type'];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);

    }//end of Supplier

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_purchase')->withPivot(['quantity','price']);

    }//end of products

    public function getStatusAttribute(){
        return $this->payment_status == 1 ? __('site.cash') : __('site.defrred');
    }

    public function getTypeAttribute(){
        return $this->payment_type == 2 ?  __('site.return') : __('site.new');

    }

}
