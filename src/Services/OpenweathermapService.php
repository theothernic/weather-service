<?php
    namespace Theothernic\WeatherService\Services;

    use Bearlovescode\Common\Models\IConfiguration;
    use Bearlovescode\Common\Traits\Configuration\UsesConfiguration;
    use Theothernic\WeatherService\Clients\OpenweathermapClient;

    class OpenweathermapService
    {
        use UsesConfiguration;

        const BASE_URL = 'https://api.openweathermap.org';

        private IConfiguration $config;

        public function __construct(IConfiguration $config)
        {
            $config->set('base_uri', self::BASE_URL);

            $this->setConfig($config);
            $this->setClient(new OpenweathermapClient($config));
        }

        public function setClient(OpenweathermapClient $client)
        {
            $this->client = $client;
        }


        public function getCurrentWeather(string $q = null)
        {
            $current = $this->client->currentWeather($q);
        }


    }