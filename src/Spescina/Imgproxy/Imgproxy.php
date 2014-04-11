<?php namespace Spescina\Imgproxy;

use Illuminate\Support\Facades\URL;

class Imgproxy {

        const PREFIX = 'packages/spescina/imgproxy';

        public function link($path, $width, $height)
        {
                $url = array(self::PREFIX, $width, $path);

                return URL::to(implode('/', $url));
        }

}
