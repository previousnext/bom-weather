<?php

declare(strict_types=1);

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

  protected string|array $supportedInterfaceOrClass = Observation::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $type, $format = NULL, array $context = []) {
    $station = (new Station())
      ->setId($data['wmo'])
      ->setLatitude($data['lat'])
      ->setLongitude($data['lon'])
      ->setName($data['name']);

    $temperature = (new Temperature())
      ->setAirTemp($data['air_temp'])
      ->setApparentTemp($data['apparent_t'])
      ->setDeltaT($data['delta_t'])
      ->setDewPoint($data['dewpt'])
      ->setRelativeHumidity($data['rel_hum']);

    $wind = (new Wind())
      ->setDirection($data['wind_dir'])
      ->setGustKmh($data['gust_kmh'])
      ->setGustKnots($data['gust_kt'])
      ->setSpeedKmh($data['wind_spd_kmh'])
      ->setSpeedKnots($data['wind_spd_kt']);

    $pressure = new Pressure();
    if (isset($data['press_msl'])) {
      $pressure->setMeanSeaLevel($data['press_msl']);
    }
    if (isset($data['press_qnh'])) {
      $pressure->setQnh($data['press_qnh']);
    }

    return (new Observation())
      ->setDateTime($this->serializer->denormalize($data['aifstime_utc'], \DateTimeImmutable::class))
      ->setRainSince9am($data['rain_trace'])
      ->setPressure($pressure)
      ->setTemperature($temperature)
      ->setWind($wind)
      ->setStation($station);
  }

}
