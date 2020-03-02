<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountInfo extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'account_info';
}
