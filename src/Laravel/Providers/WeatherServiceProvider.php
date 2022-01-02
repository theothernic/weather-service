<?php
    namespace Theothernic\WeatherService\Laravel\Providers;


    use Bearlovescode\Common\Models\Configuration;
    use Illuminate\Support\ServiceProvider;
    use Theothernic\WeatherService\Models\Configuration\WeatherConfiguration;
    use Theothernic\WeatherService\Services\NoaaWeatherService;
    use Theothernic\WeatherService\Services\OpenweathermapService;

    class WeatherServiceProvider extends ServiceProvider
    {

        public function boot()
        {

        }

        public function register()
        {
            $this->setupNoaaService();
            $this->setupOpenweathermapService();
        }

        public function setupOpenweathermapService()
        {
            if (env('OPENWEATHERMAP_ENABLED') === true)
            {
                $config = new WeatherConfiguration(config('services.openweathermap'));

                $this->app->singleton(OpenweathermapService::class, function ($app) use ($config) {
                    return new OpenweathermapService($config);
                });
            }

        }

        public function setupNoaaService()
        {
            $config = new WeatherConfiguration(config('services.noaa'));

            $this->app->singleton(NoaaWeatherService::class, function ($app) use ($config) {
                return new NoaaWeatherService($config);
            });
        }

    }