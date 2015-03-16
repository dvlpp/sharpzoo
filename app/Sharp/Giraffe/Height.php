<?php namespace App\Sharp\Giraffe;

use Dvlpp\Sharp\ListView\Renderers\SharpRenderer;

class HeightColumnsRenderer implements SharpRenderer {

    function render($instance, $key, $options)
    {
        $heightInCm = $instance->height;
        return $this->cmToInches($heightInCm);
    }

    private function cmToInches($heightInCm)
    {
        $inches = ceil($heightInCm/2.54);
        $feet = floor(($inches/12));
        return $feet."'".($inches%12).'"';
    }

} 