<?php

namespace App\Services\DynamicLink;

class GeneratorForLocal implements GeneratorInterface
{
    public function generate($id)
    {
        return "exp://192.168.100.61:19000/?page=product&id=".$id;
    }
}
