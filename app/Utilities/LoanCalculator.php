<?php



namespace App\Utilities;
use App\Models\TransactionFee;



class LoanCalculator {



    public $payable_amount;

    private $apply_amount;

    private $first_payment_date;

    private $interest_rate;

    private $term;
    private $loan;

    private $term_period;

    private $late_payment_penalties;
    private $transactionFees;



    public function __construct($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties, $loan = []) {

        $this->apply_amount           = $apply_amount;

        $this->first_payment_date     = $first_payment_date;

        $this->interest_rate          = $interest_rate;

        $this->term                   = $term;
        $this->loan                   = ($loan) ? $loan : [];
        $this->term_period            = $term_period;


        $this->late_payment_penalties = $late_payment_penalties;
        $this->transactionFees = TransactionFee::all();

    }



    public function get_flat_rate() {

        $this->payable_amount = (($this->interest_rate / 100) * $this->apply_amount) + $this->apply_amount;



        $date             = $this->first_payment_date;

        $principle_amount = $this->apply_amount / $this->term;

        $amount_to_pay    = $principle_amount + (($this->interest_rate / 100) * $principle_amount);

        $interest         = (($this->interest_rate / 100) * $this->apply_amount) / $this->term;

        $balance          = $this->payable_amount;

        $penalty          = (($this->late_payment_penalties / 100) * $this->apply_amount);



        $data = array();

        for ($i = 0; $i < $this->term; $i++) {

            $balance = $balance - $amount_to_pay;

            $data[]  = array(

                'date'             => $date,

                'amount_to_pay'    => $amount_to_pay,

                'penalty'          => $penalty,

                'principle_amount' => $principle_amount,

                'interest'         => $interest,

                'balance'          => $balance,

            );



            $date = date("Y-m-d", strtotime($this->term_period, strtotime($date)));

        }



        return $data;

    }



    public function get_fixed_rate() {

        $this->payable_amount = ((($this->interest_rate / 100) * $this->apply_amount) * $this->term) + $this->apply_amount;

        $date                 = $this->first_payment_date;

        $principle_amount     = $this->apply_amount / $this->term;
        $fees = 0;
        if($this->loan)
        {
            foreach($this->transactionFees as $transactionFee)
            {
                if($this->loan->applied_amount >= $transactionFee->amount_from && $this->loan->applied_amount < $transactionFee->amount_to){
                    $fees += $this->loan->loan_product->transactionFee->contains($transactionFee->id) ? ($transactionFee->amount / $this->loan->loan_product->term ) : 0;
                }
                
            }
        }
        
        

        $amount_to_pay        = $principle_amount + (($this->interest_rate / 100) * $this->apply_amount);
        $amount_to_pay += $fees;

        $interest             = (($this->interest_rate / 100) * $this->apply_amount);

        $balance              = $this->payable_amount;

        $penalty              = (($this->late_payment_penalties / 100) * $this->apply_amount);



        $data = array();

        for ($i = 0; $i < $this->term; $i++) {

            $balance = $balance - $amount_to_pay;

            $data[]  = array(

                'date'             => $date,

                'amount_to_pay'    => $amount_to_pay,

                'penalty'          => $penalty,

                'principle_amount' => $principle_amount,

                'interest'         => $interest,

                'balance'          => $balance,

            );



            $date = date("Y-m-d", strtotime($this->term_period, strtotime($date)));

        }



        return $data;

    }



    public function get_diminishing_rate() {

        $date                 = $this->first_payment_date;

        $principle_amount     = $this->apply_amount / $this->term;
        $fees = 0;
        if($this->loan)
        {
            foreach($this->transactionFees as $transactionFee)
            {
                if($this->loan->applied_amount >= $transactionFee->amount_from && $this->loan->applied_amount < $transactionFee->amount_to){
                    $fees += $this->loan->loan_product->transactionFee->contains($transactionFee->id) ? ($transactionFee->amount / $this->loan->loan_product->term ) : 0;
                }
            }
        }

        $balance              = $this->apply_amount;
        // dd($balance);

        $penalty              = (($this->late_payment_penalties / 100) * $this->apply_amount); 
        // dd($this->interest_rate);

        $payable_amount = 0;
        $int = $this->interest_rate / 100;
        // dd($int);

        $data = array();

            // dump($int);
            
            $a = 1 + ($int / 12);
            // dump($a);

            $aa = pow($a, $this->term);
            // dump($aa);
            // dd($aa); //2.0141723800043E-13

            // dump($balance);
            
            $bb = ($balance * ($int / 12));
            // dump($bb); // interest

            $cc = ($bb) * ($aa);
            // dump($cc); //4.1961924583423E-9

            $q = 1 + ($int / 12);
            // dump($q);

            $ad = pow($q, $this->term);
            $ad = $ad - 1;
            // dd($ad);

            $amount_to_pay       = $cc / $ad;

            // dd($amount_to_pay);
            // $amount_to_pay        = (($this->interest_rate / 100) * $balance) / 12;

            // $interest = (pow((1 + (($this->interest_rate / 100) / 12)), $this->term)) - 1;
            // dd($balance);
            
            $interest = $bb;
            
            // interest old
            // $interestt = (($this->interest_rate / 100) / 12) * $this->term * $balance;
            // dd($interest);
            
            $principle_amount = $amount_to_pay - $interest;
            
            // $amount_to_pay = $amount_to_pay / $interest;
            // dd($amount_to_pay);
            // dd($principle_amount);
            
            $payable_amount     = $payable_amount + $amount_to_pay;

            $w = $balance * (($this->interest_rate / 100) / 12);

            $balance = $balance - $principle_amount;
            for ($i = 0; $i < $this->term; $i++) {

                $data[]  = array(

                    'date'             => $date,

                    'amount_to_pay'    => $amount_to_pay,

                    'penalty'          => $penalty,

                    'principle_amount' => $principle_amount,

                    'interest'         => $interest,

                    'balance'          => $balance,

                );

                $interest = ($balance * ($int/12));
                $principle_amount = $amount_to_pay - $interest;
                $balance = $balance - $principle_amount;
            



            $date = date("Y-m-d", strtotime($this->term_period, strtotime($date)));

        }
        $this->payable_amount = ((($this->interest_rate / 100) * $this->apply_amount) * $this->term) + $this->apply_amount;



        return $data;

    }



    public function get_mortgage() {

        $interestRate = $this->interest_rate / 100;

        $fees = 0;
        if($this->loan)
        {
            foreach($this->transactionFees as $transactionFee)
            {
                if($this->loan->applied_amount >= $transactionFee->amount_from && $this->loan->applied_amount < $transactionFee->amount_to){
                    $fees += $this->loan->loan_product->transactionFee->contains($transactionFee->id) ? ($transactionFee->amount / $this->loan->loan_product->term ) : 0;
                }
            }
        }

        //Calculate the per month interest rate

        $monthlyRate = $interestRate / 12;

        

        //Calculate the payment

        $payment = $this->apply_amount * ($monthlyRate / (1 - pow(1 + $monthlyRate, -$this->term)));



        $this->payable_amount = $payment * $this->term;



        $date    = $this->first_payment_date;

        $balance = $this->apply_amount;

        $penalty = (($this->late_payment_penalties / 100) * $this->apply_amount);



        $data = array();

        for ($count = 0; $count < $this->term; $count++) {

            $interest         = $balance * $monthlyRate;

            $monthlyPrincipal = $payment - $interest;

            $amount_to_pay    = $interest + $monthlyPrincipal + $fees;



            $balance = $balance - $monthlyPrincipal;

            $data[]  = array(

                'date'             => $date,

                'amount_to_pay'    => $amount_to_pay,

                'penalty'          => $penalty,

                'principle_amount' => $monthlyPrincipal,

                'interest'         => $interest,

                'balance'          => $balance,

            );



            $date = date("Y-m-d", strtotime($this->term_period, strtotime($date)));

        }



        return $data;

    }



    public function get_one_time() {

        $this->payable_amount = (($this->interest_rate / 100) * $this->apply_amount) + $this->apply_amount;

        $date                 = $this->first_payment_date;

        $principle_amount     = $this->apply_amount;

        $amount_to_pay        = $principle_amount + (($this->interest_rate / 100) * $principle_amount);

        $interest             = (($this->interest_rate / 100) * $this->apply_amount);

        $balance              = $this->payable_amount;

        $penalty              = (($this->late_payment_penalties / 100) * $this->apply_amount);



        $data    = array();

        $balance = $balance - $amount_to_pay;

        $data[]  = array(

            'date'             => $date,

            'amount_to_pay'    => $amount_to_pay,

            'penalty'          => $penalty,

            'principle_amount' => $principle_amount,

            'interest'         => $interest,

            'balance'          => $balance,

        );



        $date = date("Y-m-d", strtotime($this->term_period, strtotime($date)));



        return $data;

    }



}