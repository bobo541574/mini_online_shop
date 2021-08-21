<?php

namespace App\Services;

use Illuminate\Support\Facades\App;

class Address
{
    protected array $config;

    protected $locale;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->locale(App::getLocale());
    }

    public function locale($locale): Address
    {
        $this->locale = $locale;
        return $this;
    }

    public function stateList()
    {
        return $this->get('regions');
    }

    public function cityListByState($stateId = "ayeyarwady")
    {
        return $this->get('cities')[$stateId];
    }

    public function townshipListByCity($cityId = "bogale")
    {
        return $this->get('townships')[$cityId];
    }

    public function findAddress($address): string
    {
        $data = [
            ...$this->findTownship($address->city, $address->township),
            ...$this->findCity($address->state, $address->city),
            ...$this->findState($address->state),
        ];

        $data = array_column($data, 'name');

        if ($this->locale == "mm") {
            return $data[0] . '၊ ' . $data[1] . '၊ ' . $data[2];
        } else {
            return $data[0] . ', ' . $data[1] . ', ' . $data[2];
        }
    }

    public function findState($name)
    {
        $states = $this->get('regions');

        return array_filter($states, function ($state) use ($name) {
            return $state['key'] == $name;
        });
    }

    public function findCity($state, $name): array
    {
        $cities = $this->get('cities');

        return array_filter($cities[$state], function ($city) use ($name) {
            return $city['key'] == $name;
        });
    }

    public function findTownship($city, $name): array
    {
        $townships = $this->get('townships');

        return array_filter($townships[$city], function ($township) use ($name) {
            return $township['key'] == $name;
        });
    }

    protected function get($type)
    {
        return $this->config[$type][$this->locale];
    }
}
