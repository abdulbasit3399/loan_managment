<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionFee extends Model
{
    use HasFactory;

    public function loanProduct() {
        return $this->belongsToMany('App\Models\LoanProduct', 'loan_product_transaction_fees', 'transaction_fee_id', 'loan_product_id');
    }
}
