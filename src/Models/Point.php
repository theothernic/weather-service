<?php
    namespace Theothernic\WeatherService\Models;

    class Point
    {
        public float $x = 0;
        public float $y = 0;

        public function __construct(float $x, float $y)
        {
            $this->x = floatval($x);
            $this->y = floatval($y);
        }


        public function __toString()
        {
            return sprintf('%f,%f', $this->x, $this->y);
        }
    }