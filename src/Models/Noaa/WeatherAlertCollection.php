<?php
    namespace Theothernic\WeatherService\Models\Noaa;


    use Bearlovescode\Common\Models\Model;

    class WeatherAlertCollection extends Model
    {
        public function __construct(mixed $data = null)
        {
            // make sure that the alerts property is initialized.
            $this->_vars['alerts'] = [];

            $this->using(['title', 'features']);
            parent::__construct($data);
        }

        public function hydrate(mixed $data = null): void
        {
            // convert "features" into alerts.
            $this->hydrateAlerts($data->features);
            unset($data->features);

            parent::hydrate($data);
        }
        private function hydrateAlerts(array $alerts = []) : void
        {
            if (!empty($alerts))
                foreach ($alerts as $alert)
                    $this->_vars['alerts'][] = new WeatherAlert($alert->properties); // stripping/skipping the 'feature' data layer
        }

        public function getAlerts() : array|null
        {
            return $this->_vars['alerts'] ?? null;
        }
    }