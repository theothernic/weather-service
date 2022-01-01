<?php
    namespace Theothernic\WeatherService\Services;

    use Bearlovescode\Common\Models\IConfiguration;
    use Bearlovescode\Common\Models\Model;
    use Bearlovescode\Common\Traits\Configuration\UsesConfiguration;
    use Theothernic\WeatherService\Clients\NoaaClient;
    use Theothernic\WeatherService\Clients\WeatherClient;
    use Theothernic\WeatherService\Models\Configuration\WeatherConfiguration;

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
            $alertData = json_encode($this->client->getActiveAlerts($area));

            foreach ($alertData as $alert)
                $alertList[] = $alert;

            return $alertList;
        }
    }