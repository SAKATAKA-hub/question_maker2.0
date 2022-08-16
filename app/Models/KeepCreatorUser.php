<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  クリエーターのキープ
 * ===============================
 */
class KeepCreatorUser extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id','creater_user_id','keep',
    ];
}
