<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $input)
 */
class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'name',
        'type',
        'options',
        'comment'
    ];

    protected $casts = [
        'options' => 'array'
    ];
}
