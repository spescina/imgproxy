<?php namespace Psimone\Imgproxy\Classes;

use Illuminate\Support\Facades\URL;

class Imgproxy {

        const PREFIX = 'packages/psimone/imgproxy';

        public function link($path, $width, $height)
        {
                $url = array(self::PREFIX, $width, $height, $path);

                return URL::to(implode('/', $url));
        }

}
