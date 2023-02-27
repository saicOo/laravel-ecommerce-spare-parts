<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['remaining_amount'];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);

    }//end of Supplier

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_purchase')->withPivot(['quantity','price']);

    }//end of products

    public function getRemainingAmountAttribute(){
        $remaining_amount = $this->amount_paid - $this->total_price;
        return $remaining_amount;
    }
}
