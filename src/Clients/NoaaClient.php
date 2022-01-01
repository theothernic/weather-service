<?php
    namespace Theothernic\WeatherService\Clients;

    use GuzzleHttp\Psr7\Request;
    use GuzzleHttp\Exception\GuzzleException;
    use Theothernic\WeatherService\Exceptions\WeatherClientException;

    class NoaaClient extends WeatherClient
    {
        /**
         * @param string|null $id Zone identifier.
         * @param string $type  Zone type. One of 'area', 'zone'
         * @return object|null
         * @throws GuzzleException
         * @throws WeatherClientException
         */
        public function getActiveAlerts(string $id = null, string $type = 'zone') : mixed
        {
            if (!in_array($type, ['area', 'zone']))
                return null;

            if (empty($id))
                return null;

            $uri = sprintf('/alerts/active?%s=%s', $type, $id);

            $req = new Request('GET', $uri);
            $resp = parent::go($req);
            $data = $resp->getBody()->getContents();

            if (!$resp->getStatusCode() == 200)
                throw new WeatherClientException($data, $resp->getStatusCode());

            return $data;
        }
    }