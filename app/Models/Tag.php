<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  タグ
 * ===============================
 */
class Tag extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'text','count',
    ];
}
