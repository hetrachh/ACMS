<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetMaster extends Model
{
    protected $fillable = ['asset_id', 'asset_category', 'asset_name', 'emp_code'];
    protected $primaryKey = 'asset_id';
}
