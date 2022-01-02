<?php
    namespace Theothernic\WeatherService\Services;

    use Bearlovescode\Common\Models\IConfiguration;
    use Bearlovescode\Common\Models\Model;
    use Bearlovescode\Common\Traits\Configuration\UsesConfiguration;
    use Theothernic\WeatherService\Clients\NoaaClient;
    use Theothernic\WeatherService\Clients\WeatherClient;
    use Theothernic\WeatherService\Models\Configuration\WeatherConfiguration;
    use Theothernic\WeatherService\Models\Noaa\WeatherAlert;
    use Theothernic\WeatherService\Models\Noaa\WeatherAlertFeatureCollection;

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
        public function getActiveAlerts(string $area = null) : array|null
        {
            if (empty($area))
                return null;

            $alertList = [];
            $alertData = json_decode($this->client->getActiveAlerts($area));
            return $this->hydrateAlerts($alertData);
        }


        private function hydrateAlerts(array|object $alertData) : array
        {
            $data = [];

            if (is_array($alertData))
                foreach ($alertData as $alert)
                    $data[] = new WeatherAlertFeatureCollection($alert);

            else
                $data[] = new  WeatherAlertFeatureCollection($alertData);

            return $data;
        }
    }