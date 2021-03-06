<?php
    namespace Theothernic\WeatherService\Models\Noaa;


    use Bearlovescode\Common\Models\Model;

    class NoaaForecast extends Model
    {
        public function hydrate(mixed $data = null): void
        {
            if (property_exists($data, 'periods') && !empty($data->periods))
                $this->hydratePeriods($data->periods);
            unset($data->periods);

            parent::hydrate($data);
        }

        /**
         * @param array|null $periods
         * @return void
         */
        public function hydratePeriods(array $periods = null) : void
        {
            foreach ($periods as $period)
                $this->_vars['periods'][] = new NoaaForecastPeriod($period);
        }
    }