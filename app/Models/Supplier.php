<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['status'];

    public function getStatusAttribute(){
        return ($this->account_status == 1 ? __('site.credit') : ($this->account_status == 2 ? __('site.debit') : __('site.balanced')));
    }
}
