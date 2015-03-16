<?php namespace App\Sharp\Giraffe\Show;

use Illuminate\Database\Eloquent\Model;

class Show extends Model {

    public function giraffe()
    {
        return $this->belongsTo('\App\Sharp\Giraffe\Giraffe');
    }
} 