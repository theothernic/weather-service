<?php
    namespace Theothernic\WeatherService\Models\Noaa;


    use Bearlovescode\Common\Models\Model;

    class WeatherAlert extends Model
    {
        public function __construct(mixed $data = null)
        {
            $this->using(['title', 'features']);

            parent::__construct($data);
        }
    }