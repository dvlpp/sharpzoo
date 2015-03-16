<?php namespace App\Sharp\Webpage\Webblock;

use Illuminate\Database\Eloquent\Model;

class Webblock extends Model {

    public function webpage()
    {
        return $this->belongsTo('\App\Sharp\Webpage\Webpage');
    }

} 