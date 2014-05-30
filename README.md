[![Build Status](https://travis-ci.org/spescina/imgproxy.svg?branch=master)](https://travis-ci.org/spescina/imgproxy?branch=master)
[![Coverage Status](https://coveralls.io/repos/spescina/imgproxy/badge.png?branch=master)](https://coveralls.io/r/spescina/imgproxy?branch=master)
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

Publish the package config running `php artisan config:publish spescina/imgproxy`

ImageProxy is configured to use Apache by default. If you are using nginx, add the following to your site configuration file:
```
rewrite ^/packages/spescina/imgproxy/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)/(.*) /packages/spescina/imgproxy/timthumb.php?w=$1&h=$2&zc=$3&q=$4&src=$5;
```

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
* __quality__ - optional [0..100] - Default: 90
* __zoom/crop__ - optional [0,1,2,3] - Default: 1

### Zoom/Crop
These are the supported values
* __0__ - Resize to Fit specified dimensions (no cropping)	
* __1__	- Crop and resize to best fit the dimensions (default)
* __2__	- Resize proportionally to fit entire image into specified dimensions, and add borders if required
* __3__	- Resize proportionally adjusting size of scaled image so there are no borders gaps

## Config

### Package config

After publishing the package config file it's possible to change the package behaviour in the `app/config/packages/spescina/imgproxy/config.php` file.  

These are the current options: 
* __rewrite__ - Default: `true` - If `false` querystring uri are generated instead of pretty ones

### Timthumb config

It's possible to edit timthumb config in the `public/packages/spescina/imgproxy/timthumb-config.php` file.  

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

## Full nginx example for Laravel Forge

```
server {
    rewrite_log on;

    listen 80;
    server_name my_site.com;
    root /home/forge/my_site.com/public;

    auth_basic "Restricted";
    auth_basic_user_file /home/forge/my_site.com/public/.htpasswd;

    # FORGE SSL (DO NOT REMOVE!)
    # ssl on;
    # ssl_certificate;
    # ssl_certificate_key;

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        rewrite ^/packages/spescina/imgproxy/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)/(.*) /packages/spescina/imgproxy/timthumb.php?w=$1&h=$2&zc=$3&q=$4&src=$5;
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log off;
    error_log  /var/log/nginx/my_site.com-error.log error;

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```