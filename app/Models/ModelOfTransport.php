<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelOfTransport extends Model
{
    use HasFactory;

    protected $table = 'mode_of_transport';

    protected $fillable = ['name_mode_of_transport'];

    public $timestamps = false;
}
