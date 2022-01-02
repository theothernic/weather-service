<?php
    namespace Theothernic\WeatherService\Clients;

    use Bearlovescode\Common\Http\HttpClient;

    class OpenweathermapClient extends HttpClient
    {
        public function currentWeather(string $q) : object
        {
            $params = http_build_query([
                'q' => $q,
                'appid' => $this->config->get('apikey')
            ]);

            $uri = sprintf('/data/2.5/weather?%s', $params);



        }
    }