<?php
    namespace Theothernic\WeatherService\Clients;

    use GuzzleHttp\Psr7\Request;
    use GuzzleHttp\Exception\GuzzleException;
    use Theothernic\WeatherService\Exceptions\WeatherClientException;

    class NoaaClient extends WeatherClient
    {
        /**
         * @param string|null $area
         * @return object|null
         * @throws GuzzleException|WeatherClientException
         */
        public function getActiveAlerts(string $area = null) : mixed
        {
            if (empty($area))
                return null;

            $uri = sprintf('/alerts/active?area=%s', $area);

            $req = new Request('GET', $uri);
            $resp = parent::go($req);
            $data = $resp->getBody()->getContents();

            if (!$resp->getStatusCode() == 200)
                throw new WeatherClientException($data, $resp->getStatusCode());

            return $data;
        }
    }