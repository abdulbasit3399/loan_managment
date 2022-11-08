<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanProduct extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loan_products';

    public function transactionFee() {
        return $this->belongsToMany('App\Models\TransactionFee', 'loan_product_transaction_fees', 'loan_product_id', 'transaction_fee_id');
    }
}