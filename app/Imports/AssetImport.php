<?php

namespace App\Imports;

use App\AssetMaster;
use Maatwebsite\Excel\Concerns\ToModel;

class AssetImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AssetMaster([
            'asset_id'     => $row[0],
            'asset_category'    => $row[1],
            'asset_name' => $row[2],
            'emp_code' => $row[3],
        ]);
    }
}
