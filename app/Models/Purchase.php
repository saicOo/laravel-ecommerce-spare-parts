<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['remaining_amount','status','type_method'];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);

    }//end of Supplier

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_purchase')->withPivot(['quantity','price']);

    }//end of products

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

    public function getTypeMethodAttribute(){
        return $this->type == 2 ?  __('site.return') : __('site.new');

    }

    public function getRemainingAmountAttribute(){
        $remaining_amount = $this->amount_paid - $this->total_price;
        return $remaining_amount;
    }
}
