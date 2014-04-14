[![Build Status](https://travis-ci.org/spescina/imgproxy.svg?branch=master)](https://travis-ci.org/spescina/imgproxy)
[![Coverage Status](https://coveralls.io/repos/spescina/imgproxy/badge.png?branch=develop)](https://coveralls.io/r/spescina/imgproxy?branch=develop)
# ImageProxy  

Laravel 4 package for image cropping and resizing on the fly. It uses Timthumb under the hood.

## Install && Usage

Add in `composer.json`  
```
"require": {
    "spescina/imgproxy": "2.x"
}
```

Run `composer update`  

Add the service provider in the `app/config/app.php` file  
```
"Spescina\Imgproxy\ImgproxyServiceProvider"
```

Publish the package assets running `php artisan asset:publish spescina/imgproxy`

Use the package facade to generate the resource url
```
ImgProxy::link("path/to/image.jpg", 100, 80)
```
This will generate a link like this
```
http://www.yourdomain.com/packages/spescina/imgproxy/100/80/path/to/image.jpg
```
that generates an image with dimensions 100 x 80 using the original `image.jpg` stored in the `public/path/to` folder.  

## Parameters

The `link` function accepts 5 paramaters
* __image path__
* __width__
* __height__
* __zoom/crop__ - optional [0,1,2,3] - Default: 1
* __quality__ - optional [0..100] - Default: 90

### Zoom/Crop
These are the supported values
* __0__ - Resize to Fit specified dimensions (no cropping)	
* __1__	- Crop and resize to best fit the dimensions (default)
* __2__	- Resize proportionally to fit entire image into specified dimensions, and add borders if required
* __3__	- Resize proportionally adjusting size of scaled image so there are no borders gaps

## Config

After publishing the assets it's possible to edit package config in the `public/packages/spescina/imgproxy/timthumb-config.php` file.  

These, at the moment, are the default values
```
define ("DEBUG_ON", false);

define ("DEBUG_LEVEL", 3);

define ("FILE_CACHE_MAX_FILE_AGE", 86400);

define ("FILE_CACHE_SUFFIX", ".imgproxy.cache");

define ("FILE_CACHE_PREFIX", "");

define ("FILE_CACHE_DIRECTORY", "../../../../app/storage/cache/imgproxy");

define ("NOT_FOUND_IMAGE", "./nophoto.gif");

define ("ERROR_IMAGE", "./nophoto.gif");

define ("PNG_IS_TRANSPARENT", FALSE);

define ("DEFAULT_Q", 90);
```
