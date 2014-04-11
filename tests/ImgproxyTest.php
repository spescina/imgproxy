<?php

use Illuminate\Support\Facades\URL;
use Spescina\Imgproxy\Imgproxy;

use Mockery as m;

class ImgproxyTest extends PHPUnit_Framework_TestCase {

        public function tearDown()
        {
                m::close();
        }
        
        public function test_image_link_building()
        {
                URL::shouldReceive('to')
                        ->once()
                        ->with("packages/spescina/imgproxy/100/70/image/path/url.jpg")
                        ->andReturn("http://www.example.com/packages/spescina/imgproxy/100/70/image/path/url.jpg");
                
                $imgProxy = new Imgproxy;
                
                $url = $imgProxy->link("image/path/url.jpg", 100, 70);
                
                $this->assertEquals("http://www.example.com/packages/spescina/imgproxy/100/70/image/path/url.jpg", $url);
        }

}
