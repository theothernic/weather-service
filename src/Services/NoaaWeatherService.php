<?php
    namespace Theothernic\WeatherService\Services;

    use Bearlovescode\Common\Models\IConfiguration;
    use Bearlovescode\Common\Traits\Configuration\UsesConfiguration;
    use Theothernic\WeatherService\Clients\NoaaClient;
    use Theothernic\WeatherService\Models\Noaa\NoaaForecast;
    use Theothernic\WeatherService\Models\Noaa\WeatherAlertCollection;
    use Theothernic\WeatherService\Models\Point;

    class NoaaWeatherService
    {
        use UsesConfiguration;

        private NoaaClient $client;
        private IConfiguration $config;

        public const BASE_URL = 'https://api.weather.gov';

        public function __construct(IConfiguration $config)
        {
            $config->set('base_uri', self::BASE_URL);

            $this->setConfig($config);
            $this->setClient(new NoaaClient($this->config));
        }

        public function setClient(NoaaClient $client)
        {
            $this->client = $client;
        }


        /**
         * @param string|null $area the forecast zone or county code.
         * @return array|null
         * @throws \GuzzleHttp\Exception\GuzzleException
         * @throws \Theothernic\WeatherService\Exceptions\WeatherClientException
         */
        public function getActiveAlerts(string $area = null) : WeatherAlertCollection|array|null
        {
            if (empty($area))
                return null;

            $alertData = json_decode($this->client->getActiveAlerts($area));
            return $this->prepareAlerts($alertData);
        }

        public function getForecastForCoords(Point $coords) : NoaaForecast
        {
            $forecast = $this->client->getForecastForCoords($coords);
            return new NoaaForecast($forecast->properties);
        }


        /**
         * @param array|object $alertData
         * @return WeatherAlertCollection|array|null
         */
        private function prepareAlerts(array|object $alertData) : WeatherAlertCollection|array|null
        {
            $data = null;

            if (is_array($alertData))
                foreach ($alertData as $alert)
                    $data[] = new WeatherAlertCollection($alert);

            else
                $data = new WeatherAlertCollection($alertData);

            return $data;
        }
    }