<?php namespace App\Sharp\Zone;

use Dvlpp\Sharp\Validation\SharpValidator;

class Validator extends SharpValidator {

    public function getRules()
    {
        return [
            "name" => "required"
        ];
    }

} 