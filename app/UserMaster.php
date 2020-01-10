<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMaster extends Model
{
    protected $fillable = ['emp_code', 'emp_name', 'emp_phno', 'emp_email', 'emp_designation', 'emp_password', 'emp_status', 'emp_type'];
    protected  $primaryKey = 'emp_code';
}
