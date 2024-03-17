<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if(!Storage::exists('public/imagesfactory')):
            Storage::makeDirectory('public/imagesfactory');
        endif;
        $urlPublicPath = public_path('storage/imagesfactory');
        $urlFakerImage = $this->faker->image($urlPublicPath, 640, 480, null, false);
        $urlFull = '/storage/imagesfactory/'.$urlFakerImage;
        return [
            'url' => $urlFull,
            'main' => true
        ];
    }
}
