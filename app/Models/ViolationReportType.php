<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  問題集の違反通報の種類
 * ===============================
 */
class ViolationReportType extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['text',];
}
