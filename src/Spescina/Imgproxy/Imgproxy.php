<?php namespace Spescina\Imgproxy;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class Imgproxy {

        const PREFIX = 'packages/spescina/imgproxy';
        const FILE = 'timthumb.php';
        
        const Q = 90;
        const ZC = 1;

        public function link($path, $width, $height, $quality = null, $zoomCrop = null)
        {
                $q = is_null($quality) ? self::Q : $quality;
                
                $zc = is_null($zoomCrop) ? self::ZC : $zoomCrop;
                
                $url = array(
                        'base' => self::PREFIX,
                        'w' => $width,
                        'h' => $height,
                        'zc' => $zc,
                        'q' => $q,
                        'src' => $path
                );
                
                return $this->getUrl($url);
                
        }
        
        private function getUrl($url)
        {
                return Config::get('imgproxy::rewrite') ? $this->build_rewrited($url) : $this->build_urlencoded($url);
        }
        
        private function build_urlencoded($url)
        {
                $base = array_shift($url);
                
                return URL::to($base . '/' . self::FILE . '?' . urldecode(http_build_query($url)));
                
        }
        
        private function build_rewrited($url)
        {
                $values = array_values($url);
                
                return URL::to(implode('/', $values));
        }

}
