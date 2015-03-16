<?php namespace App\Sharp\Giraffe;

use Dvlpp\Sharp\Validation\SharpValidator;

class Validator extends SharpValidator {

    public function getRules()
    {
        return [
            "name" => "required",
//            "picture" => "required",
            "age" => "required|integer",
            "height" => "integer",
        ];
    }

    public function getUpdateRules()
    {
        return [
//            "photos" => "array"
        ];
    }


    /*public function getMessages()
    {
        return [
            'photos.array' => 'Please provide at least one photo.',
        ];
    }*/

} 