<?php
    namespace Theothernic\WeatherService\Services;

    use Theothernic\WeatherService\Clients\WeatherClient;

    class NoaaWeatherService
    {
        private WeatherClient $client;

        public function __construct(WeatherClient $client)
        {
            $this->client = $client;
        }


        /**
         * @param string|null $area the forecast zone or county code.
         * @return object|null
         */
        public function getActiveAlerts(string $area = null) : null|object
        {
            if (empty($zone))
                return null;

            $uri = sprintf('/alerts/active/area?=%s', $area);




            return new \stdClass();
        }
    }