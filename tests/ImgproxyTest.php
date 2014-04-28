<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Spescina\Imgproxy\Imgproxy;

use Mockery as m;

class ImgproxyTest extends PHPUnit_Framework_TestCase {

        public function tearDown()
        {
                m::close();
        }
        
        /** @test */
        public function it_generates_rewrited_url()
        {
                Config::shouldReceive('get')
                        ->once()
                        ->with("imgproxy::rewrite")
                        ->andReturn(true);
                
                URL::shouldReceive('to')
                        ->once()
                        ->with("packages/spescina/imgproxy/100/70/1/90/image/path/url.jpg")
                        ->andReturn("http://www.example.com/packages/spescina/imgproxy/100/70/1/90/image/path/url.jpg");
                
                $imgProxy = new Imgproxy;
                
                $url = $imgProxy->link("image/path/url.jpg", 100, 70);
                
                $this->assertEquals("http://www.example.com/packages/spescina/imgproxy/100/70/1/90/image/path/url.jpg", $url);
        }
        
        /** @test */
        public function it_generates_rewrited_url_with_quality()
        {
                Config::shouldReceive('get')
                        ->once()
                        ->with("imgproxy::rewrite")
                        ->andReturn(true);
                
                URL::shouldReceive('to')
                        ->once()
                        ->with("packages/spescina/imgproxy/100/70/1/70/image/path/url.jpg")
                        ->andReturn("http://www.example.com/packages/spescina/imgproxy/100/70/1/70/image/path/url.jpg");
                
                $imgProxy = new Imgproxy;
                
                $url = $imgProxy->link("image/path/url.jpg", 100, 70, 70);
                
                $this->assertEquals("http://www.example.com/packages/spescina/imgproxy/100/70/1/70/image/path/url.jpg", $url);
        }
        
        /** @test */
        public function it_generates_rewrited_url_with_quality_and_zoomcrop()
        {
                Config::shouldReceive('get')
                        ->once()
                        ->with("imgproxy::rewrite")
                        ->andReturn(true);
                
                URL::shouldReceive('to')
                        ->once()
                        ->with("packages/spescina/imgproxy/100/70/2/70/image/path/url.jpg")
                        ->andReturn("http://www.example.com/packages/spescina/imgproxy/100/70/2/70/image/path/url.jpg");
                
                $imgProxy = new Imgproxy;
                
                $url = $imgProxy->link("image/path/url.jpg", 100, 70, 70, 2);
                
                $this->assertEquals("http://www.example.com/packages/spescina/imgproxy/100/70/2/70/image/path/url.jpg", $url);
        }
        
        /** @test */
        public function it_generates_not_rewrite_url_if_config_value_is_false()
        {
                Config::shouldReceive('get')
                        ->once()
                        ->with("imgproxy::rewrite")
                        ->andReturn(false);
                
                URL::shouldReceive('to')
                        ->once()
                        ->with("packages/spescina/imgproxy/timthumb.php?w=100&h=70&zc=1&q=90&src=image/path/url.jpg")
                        ->andReturn("http://www.example.com/packages/spescina/imgproxy/timthumb.php?w=100&h=70&zc=1&q=90&src=image/path/url.jpg");
                
                $imgProxy = new Imgproxy;
                
                $url = $imgProxy->link("image/path/url.jpg", 100, 70);
                
                $this->assertEquals("http://www.example.com/packages/spescina/imgproxy/timthumb.php?w=100&h=70&zc=1&q=90&src=image/path/url.jpg", $url);
        }

}
