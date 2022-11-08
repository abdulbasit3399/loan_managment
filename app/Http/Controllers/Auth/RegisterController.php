<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Utilities\Overrider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
        Overrider::load("Settings");
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        config(['recaptchav3.sitekey' => get_option('recaptcha_site_key')]);
        config(['recaptchav3.secret' => get_option('recaptcha_secret_key')]);

        return Validator::make($data, [
            'first_name'                 => ['required', 'string', 'max:191'],
            'middle_name'                 => ['string', 'max:191'],
            'last_name'                 => ['required', 'string', 'max:191'],
            'dob'                 => ['required'],
            'present_employer_name'    => ['required'],
            'present_employer_address'    => ['required'],
            'present_employer_position'    => ['required'],
            'present_employer_since'    => ['required'],
            'present_employer_phone'    => ['required'],
            'present_length_service'    => ['required'],
            'email'                => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'country_code'         => ['required'],
            'phone'                => ['required', 'string', 'unique:users'],
            'password'             => ['required', 'string', 'min:6', 'confirmed'],
            'g-recaptcha-response' => get_option('enable_recaptcha', 0) == 1 ? 'required|recaptchav3:register,0.5' : '',
        ], [
            'g-recaptcha-response.recaptchav3' => _lang('Recaptcha error!'),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data) {
        $code = null;

        if($data['company_code']){
            $prev_usr = User::where('company_code',strtoupper($data['company_code']))->first();
                if($prev_usr)
                    $code = $prev_usr->id;
        }

        $dateOfBirth = $data['dob'];
        $today = date("Y-m-d");
        $age = date_diff(date_create($dateOfBirth), date_create($today));
        $age = $age->format('%y');

        return User::create([
            'first_name'              => $data['first_name'],
            'middle_name'              => $data['middle_name'],
            'last_name'              => $data['last_name'],
            'dob'              => $data['dob'],
            'age'              => $age,
            'gender'              => $data['gender'],
            'home_address'              => $data['home_address'],
            'barangay'              => $data['barangay'],
            'city'              => $data['city'],
            'spouse_first_name'              => $data['spouse_first_name'],
            'spouse_middle_name'              => $data['spouse_middle_name'],
            'spouse_last_name'              => $data['spouse_last_name'],
            'marital_status'              => $data['marital_status'],
            'present_employer_name'              => $data['present_employer_name'] ? $data['present_employer_name'] : '',
            'present_employer_address'              => $data['present_employer_address'] ? $data['present_employer_address'] : '',
            'present_employer_position'              => $data['present_employer_position'] ? $data['present_employer_position'] : '',
            'present_employer_since'              => $data['present_employer_since'] ? $data['present_employer_since'] : '',
            'present_employer_phone'              => $data['present_employer_phone'] ? $data['present_employer_phone'] : '',
            'previous_employer_name'              => $data['previous_employer_name'] ? $data['previous_employer_name'] : '',
            'previous_employer_address'              => $data['previous_employer_address'] ? $data['previous_employer_address'] : '',
            'previous_employer_position'              => $data['previous_employer_position'] ? $data['previous_employer_position'] : '',
            'previous_employer_since'              => $data['previous_employer_since'] ? $data['previous_employer_since'] : '',
            'previous_employer_phone'              => $data['previous_employer_phone'] ? $data['previous_employer_phone'] : '',
            'spouse_present_employer_name'              => $data['spouse_present_employer_name'] ? $data['spouse_present_employer_name'] : '',
            'spouse_present_employer_address'              => $data['spouse_present_employer_address'] ? $data['spouse_present_employer_address'] : '',
            'spouse_present_employer_position'              => $data['spouse_present_employer_position'] ? $data['spouse_present_employer_position'] : '',
            'spouse_present_employer_since'              => $data['spouse_present_employer_since'] ? $data['spouse_present_employer_since'] : '',
            'spouse_present_employer_phone'              => $data['spouse_present_employer_phone'] ? $data['spouse_present_employer_phone'] : '',
            'spouse_previous_employer_name'              => $data['spouse_previous_employer_name'] ? $data['spouse_previous_employer_name'] : '',
            'spouse_preious_employer_address'              => $data['spouse_preious_employer_address'] ? $data['spouse_preious_employer_address'] : '',
            'spouse_previous_employer_position'              => $data['spouse_previous_employer_position'] ? $data['spouse_previous_employer_position'] : '',
            'spouse_previous_employer_since'              => $data['spouse_previous_employer_since'] ? $data['spouse_previous_employer_since'] : '',
            'spouse_previous_employer_phone'              => $data['spouse_previous_employer_phone'] ? $data['spouse_previous_employer_phone'] : '',
            'sbu_department'              => $data['sbu_department'] ? $data['sbu_department'] : '',
            'own_salary'              => $data['own_salary'] ? $data['own_salary'] : '',
            'present_length_service'              => $data['present_length_service'] ? $data['present_length_service'] : '',
            'other_income'              => $data['other_income'] ? $data['other_income'] : '',
            'total_income'              => $data['total_income'] ? $data['total_income'] : '',
            'fixed_obligations'              => $data['fixed_obligations'] ? $data['fixed_obligations'] : '',
            'other_living_expense'              => $data['other_living_expense'] ? $data['other_living_expense'] : '',
            'net_monthly_income'              => $data['net_monthly_income'] ? $data['net_monthly_income'] : '',
            'refference_first_name'              => $data['refference_first_name'] ? $data['refference_first_name'] : '',
            'refference_last_name'              => $data['refference_last_name'] ? $data['refference_last_name'] : '',
            'refference_company_name'              => $data['refference_company_name'] ? $data['refference_company_name'] : '',
            'refference_position'              => $data['refference_position'] ? $data['refference_position'] : '',
            'refference_address'              => $data['refference_address'] ? $data['refference_address'] : '',
            'refference_mobile'              => $data['refference_mobile'] ? $data['refference_mobile'] : '',
            'spouse_middle_name'              => $data['spouse_middle_name'] ? $data['spouse_middle_name'] : '',
            'spouse_middle_name'              => $data['spouse_middle_name'] ? $data['spouse_middle_name'] : '',
            'spouse_middle_name'              => $data['spouse_middle_name'] ? $data['spouse_middle_name'] : '',
            'email'             => $data['email'],
            'country_code'      => $data['country_code'],
            'phone'             => $data['phone'],
            'password'          => Hash::make($data['password']),
            'user_type'         => 'customer',
            'email_verified_at' => get_option('email_verification', 'disabled') == 'disabled' ? now() : null,
            'status'            => 1,
            'profile_picture'   => 'default.png',
            'company_id'   => $code,
        ]);
    }
    
    // Custom Register form
    public function showRegistrationForm()
    {
        return view('auth.register2');
    }
}
