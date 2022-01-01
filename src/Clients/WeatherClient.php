<?php
    namespace Theothernic\WeatherService\Clients;

    use Bearlovescode\Common\Http\HttpClient;
    use Bearlovescode\Common\Traits\Configuration\UsesConfiguration;

    class WeatherClient extends HttpClient
    {
        use UsesConfiguration;

    }