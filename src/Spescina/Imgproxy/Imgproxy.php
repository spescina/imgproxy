<?php namespace Spescina\Imgproxy;

use Illuminate\Support\Facades\URL;

class Imgproxy {

        const PREFIX = 'packages/spescina/imgproxy';
        
        const Q = 90;
        const ZC = 1;

        public function link($path, $width, $height, $quality = null, $zoomCrop = null)
        {
                $q = is_null($quality) ? self::Q : $quality;
                
                $zc = is_null($zoomCrop) ? self::ZC : $zoomCrop;
                
                $url = array(self::PREFIX, $width, $height, $zc, $q, $path);

                return URL::to(implode('/', $url));
        }

}
