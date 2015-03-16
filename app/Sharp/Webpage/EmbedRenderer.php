<?php namespace App\Sharp\Webpage;

use Dvlpp\Sharp\Form\Fields\SharpEmbedFieldRenderer;
use HTML;

class EmbedRenderer implements SharpEmbedFieldRenderer {

    function render($instance, $owner)
    {
        $picture = $instance->picture;
        if($picture)
        {
            $w = $h = 100;
            $filePath = $instance->getSharpFilePathFor("picture");
            if(!file_exists($filePath))
            {
                $filePath = public_path("tmp/".$picture);
            }
            return HTML::image(sharp_thumbnail($filePath, $w, $h), "", ["class"=>"img-responsive"]);
        }
        return $instance->title;
    }

} 