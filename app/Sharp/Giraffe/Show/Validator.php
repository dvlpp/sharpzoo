<?php namespace App\Sharp\Giraffe\Show;

use Dvlpp\Sharp\Validation\SharpValidator;

class Validator extends SharpValidator {

    public function getRules()
    {
        return [
            "title" => "required",
            "date" => "required"
        ];
    }

} 