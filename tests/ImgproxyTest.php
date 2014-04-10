<?php

use Illuminate\Support\Facades\URL;
use Psimone\Imgproxy\Classes\Imgproxy;

class ImgproxyTest extends PHPUnit_Framework_TestCase {

        public function tearDown()
        {
                Mockery::close();
        }
        
        public function test_image_link_building()
        {
                $domain = 'http://www.example.com';
                
                $prefix = 'packages/psimone/imgproxy';
                
                $imageUrl = 'image/path/url.jpg';
                
                $w = 100;
                
                $h = 70;
                
                URL::shouldReceive('to')
                        ->once()
                        ->with("$prefix/$w/$h/$imageUrl")
                        ->andReturn("$domain/$prefix/$w/$h/$imageUrl");
                
                $imgProxy = new Imgproxy;
                
                $url = $imgProxy->link($imageUrl, $w, $h);
                
                $this->assertEquals("$domain/$prefix/$w/$h/$imageUrl", $url);
        }

}
