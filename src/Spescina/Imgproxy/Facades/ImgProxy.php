<?php namespace Spescina\Imgproxy\Facades;

use Illuminate\Support\Facades\Facade;

class ImgProxy extends Facade {

        /**
         * Get the registered name of the component.
         *
         * @return string
         */
        protected static function getFacadeAccessor()
        {
                return 'imgproxy';
        }

}