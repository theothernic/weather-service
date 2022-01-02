<?php
    namespace Theothernic\WeatherService\Models\Noaa;

    use Bearlovescode\Common\Models\Model;

    class WeatherAlert extends Model
    {
        /**
         * @param array|object|null $data
         */
        public function __construct(array|object $data = null)
        {
            $this->using([
                'id',
                'sent',
                'effective',
                'onset',
                'expires',
                'ends',
                'status',
                'messageType',
                'category',
                'severity',
                'certainty',
                'urgency',
                'event',
                'sender',
                'senderName',
                'headline',
                'description',
                'instruction',
                'response'
            ]);
            parent::__construct($data);
        }
    }