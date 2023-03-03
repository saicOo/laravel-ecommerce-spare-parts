<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['status','method'];

    public function user()
    {
        return $this->belongsTo(User::class);

    }//end of user

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')->withPivot(['quantity','price','return_status']);

    }//end of products


    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function getStatusAttribute(){
        switch ($this->payment_status) {
            case 1:
                return __('site.paid');
                break;
            case 2:
                return __('site.pending');
                break;

            default:
            return __('site.unpaid');
                break;
        };
    }

    public function getMethodAttribute(){
        return $this->payment_method == 0 ?  __('site.cash') : __('site.online');
    }

}
