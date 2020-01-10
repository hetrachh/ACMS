<?php

namespace App\Imports;

use App\UserMaster;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UserMaster([
            'emp_code' => $row[0],
            'emp_name' => $row[1],
            'emp_phno' => $row[2],
            'emp_email' => $row[3],
            'emp_designation' => $row[4],
            'emp_password' => \Hash::make($row[5]),
            'emp_status' => $row[6],
            'emp_type' => $row[7],
        ]);
    }
}
