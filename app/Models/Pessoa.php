<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['user_id', 'name', 'age'];

    public function usuario()
    {
        return $this->belongsTo('App\Models\User');
    }
}
