<?php namespace App\Sharp\Particularity;

use Illuminate\Database\Eloquent\Model;

class Particularity extends Model {

    protected $table = "particularities";

    protected $fillable = ["name","order"];

    public function giraffes()
    {
        return $this->belongsToMany('\App\Sharp\Giraffe\Giraffe', 'giraffes_particularities');
    }

} 