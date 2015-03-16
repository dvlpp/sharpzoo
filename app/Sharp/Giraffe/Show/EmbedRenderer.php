<?php namespace App\Sharp\Giraffe\Show;

use Dvlpp\Sharp\Form\Fields\SharpEmbedFieldRenderer;

class EmbedRenderer implements SharpEmbedFieldRenderer {

    function render($instance, $owner)
    {
        return $instance->title . "<br/>" . $instance->date;
    }

} 