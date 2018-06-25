<?php

namespace BomWeather\Observation\Serializer;

use BomWeather\Observation\Observation;
use BomWeather\Observation\Pressure;
use BomWeather\Observation\Station;
use BomWeather\Observation\Temperature;
use BomWeather\Observation\Wind;
use BomWeather\Util\BaseNormalizer;

/**
 * Normalizer for observations.
 */
class ObservationNormalizer extends BaseNormalizer {

  protected $supportedInterfaceOrClass = Observation::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $class, $format = NULL, array $context = []) {

    $station = Station::create()
      ->setId($data['wmo'])
      ->setLatitude($data['lat'])
      ->setLongitude($data['lon'])
      ->setName($data['name']);

    $temperature = Temperature::create()
      ->setAirTemp($data['air_temp'])
      ->setApparentTemp($data['apparent_t'])
      ->setDeltaT($data['delta_t'])
      ->setDewPoint($data['dewpt'])
      ->setRealtiveHumidity($data['rel_hum']);

    $wind = Wind::create()
      ->setDirection($data['wind_dir'])
      ->setGustKmh($data['gust_kmh'])
      ->setGustKnots($data['gust_kt'])
      ->setSpeedKmh($data['wind_spd_kmh'])
      ->setSpeedKnots($data['wind_spd_kt']);

    $pressure = Pressure::create();
    if (isset($data['press_msl'])) {
      $pressure->setPressureMsl($data['press_msl']);
    }
    if (isset($data['press_qnh'])) {
      $pressure->setPressureQnh($data['press_qnh']);
    }

    $observation = Observation::create()
      ->setDateTime($this->serializer->denormalize($data['aifstime_utc'], \DateTime::class))
      ->setRainSince9am($data['rain_trace'])
      ->setPressure($pressure)
      ->setTemperature($temperature)
      ->setWind($wind)
      ->setStation($station);

    return $observation;
  }

}
