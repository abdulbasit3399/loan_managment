<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySoaReports extends Model
{
    use HasFactory;
    protected $table = 'company_soa_reports';

    public function company()
    {
        return $this->hasOne(User::class,'id','company_id');
    }
}
