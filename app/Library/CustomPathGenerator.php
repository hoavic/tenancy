<?php

namespace App\Library;

use App\Models\Tenant\Post;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as PathGenerators;

class CustomPathGenerator implements PathGenerators
{
    public function getPath(Media $media) : string
    {

        return date("Y").'/'.date("m").'/';

    }

    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media) . 'resized/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}