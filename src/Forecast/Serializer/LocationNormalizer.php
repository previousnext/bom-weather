<?php

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\Location;
use BomWeather\Forecast\LocationForecastPeriod;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Area normalizer.
 */
class LocationNormalizer extends BaseNormalizer {

  protected $supportedInterfaceOrClass = Location::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $class, $format = NULL, array $context = []) {

    if (!$this->serializer instanceof DenormalizerInterface) {
      throw new \RuntimeException('The serializer must implement the DenormalizerInterface.');
    }

    $location = Location::create()
      ->setAac($data['@aac'])
      ->setDescription($data['@description']);

    array_map(function ($period) use ($location) {
      $location->addForecastPeriod($this->serializer->denormalize($period, LocationForecastPeriod::class));
    }, $data['forecast-period'], [$location]);

    return $location;
  }

}
