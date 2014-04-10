<?php namespace Psimone\Imgproxy;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Psimone\Imgproxy\Classes\Imgproxy;

class ImgproxyServiceProvider extends ServiceProvider {

	/**
         * Indicates if loading of the provider is deferred.
         *
         * @var bool
         */
        protected $defer = false;

        /**
         * Bootstrap the application events.
         *
         * @return void
         */
        public function boot()
        {
                $this->package('psimone/imgproxy');
        }

        /**
         * Register the service provider.
         *
         * @return void
         */
        public function register()
        {
                $this->registerServices();

                $this->registerAlias();
        }

        /**
         * Get the services provided by the provider.
         *
         * @return array
         */
        public function provides()
        {
                return array(
                    'imgproxy',
                );
        }

        private function registerAlias()
        {
                AliasLoader::getInstance()->alias('ImgProxy', 'Psimone\Imgproxy\Facades\ImgProxy');
        }

        private function registerServices()
        {
                $this->app['imgproxy'] = $this->app->share(function($app) {
                        return new Imgproxy();
                });
        }

}
