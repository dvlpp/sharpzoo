<?php namespace App\Sharp\Zone;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model {

    protected $fillable = ["name", "order"];

    function webpage()
    {
        return $this->morphOne('\App\Sharp\Webpage\Webpage', 'owner');
    }

} 