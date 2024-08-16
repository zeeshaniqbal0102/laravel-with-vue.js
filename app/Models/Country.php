<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $guarded = ['token', '_token'];

    public function states()
    {
        return $this->hasMany(State::class)->select('id', 'country_id', 'name')->orderBy('name');
    }

    public function cities()
    {
        return $this->hasMany(City::class)->select('id', 'country_id', 'name')->orderBy('name');
    }
}
