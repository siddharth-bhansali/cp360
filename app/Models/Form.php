<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'fields'
    ];

    protected $casts = [
        'fields' => 'array'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
