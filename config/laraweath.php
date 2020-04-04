<?php

return [
    'driver' => 'weather-stack',

    /**
     * Your API access key
     */
    'token' => '837737dbee3c0ccdc0812e3ff6c676c1',

    /**
     * This is default city
     */
    'defaultCity' => 'Grozny',

    /**
     * This parameter to pass one of the unit identifiers ot the API:
     * m - for Metric
     * s - for Scientific
     * f - for Fahrenheit
     *
     * @see https://weatherstack.com/documentation#units_parameter
     */
    'units' => 'm',

    /**
     * this parameter to specify your preferred API response language using its ISO-code.
     *
     * @see https://weatherstack.com/documentation#language_parameter
     */
    'language' => 'ru',

    /**
     * @see https://weatherstack.com/documentation#query_parameter
     */
    'query' => 'fetch:id'
];
