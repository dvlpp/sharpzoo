<?php namespace App\Sharp\Webpage;

use Dvlpp\Sharp\Validation\SharpValidator;

class Validator extends SharpValidator {

    public function getRules()
    {
        return [
            "title" => "required"
        ];
    }

} 