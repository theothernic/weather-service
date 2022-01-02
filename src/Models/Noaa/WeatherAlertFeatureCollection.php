<?php
    namespace Theothernic\WeatherService\Models\Noaa;


    use Bearlovescode\Common\Models\Model;

    class WeatherAlertFeatureCollection extends Model
    {
        public function __construct(mixed $data = null)
        {
            $this->using(['title', 'features']);
            parent::__construct($data);
        }

        public function hydrate(mixed $data = null): void
        {
            $this->features = $this->hydrateAlerts($data['features']);
            unset($data['features']);

            parent::hydrate($data);
        }


        private function hydrateAlerts(array $alerts = []) : array
        {
            $data = [];

            if (!empty($alerts))
                foreach ($alerts as $alert)
                {
                    $data[] = new WeatherAlert($alert);
                }

            return $data;
        }
    }