<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = ['nome'];

    public function temporadas()
    {
        return $this->hasMany(Season::class, 'serie_id');
    }
}
