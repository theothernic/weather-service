<?php
    namespace Theothernic\WeatherService\Laravel\Providers;


    use Bearlovescode\Common\Models\Configuration;
    use Illuminate\Support\ServiceProvider;
    use Theothernic\WeatherService\Models\Configuration\WeatherConfiguration;
    use Theothernic\WeatherService\Services\NoaaWeatherService;

    class WeatherServiceProvider extends ServiceProvider
    {

        public function boot()
        {

        }

        public function register()
        {
            $this->setupNoaaService();
        }

        public function setupNoaaService()
        {
            $config = new WeatherConfiguration(config('services.noaa'));

            $this->app->singleton(NoaaWeatherService::class, function ($app) use ($config) {
                return new NoaaWeatherService($config);
            });
        }

    }