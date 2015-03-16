<?php namespace App\Sharp\Webpage\Webblock;

use Dvlpp\Sharp\Validation\SharpValidator;

class Validator extends SharpValidator {

    public function getRules()
    {
        return [
            "body" => "required",
        ];
    }

} 