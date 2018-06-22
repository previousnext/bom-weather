<?php

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\Region;
use BomWeather\Forecast\RegionForecastPeriod;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Region normalizer.
 */
class RegionNormalizer extends BaseNormalizer {

  protected $supportedInterfaceOrClass = Region::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $class, $format = NULL, array $context = []) {

    if (!$this->serializer instanceof DenormalizerInterface) {
      throw new \RuntimeException('The serializer must implement the DenormalizerInterface.');
    }

    $region = Region::create()
      ->setAac($data['@aac'])
      ->setDescription($data['@description']);

    if ($this->isAssoc($data['forecast-period'])) {
      $region->addForecastPeriod($this->serializer->denormalize($data['forecast-period'], RegionForecastPeriod::class));
    }
    else {
      array_map(function ($period) use ($region) {
        $region->addForecastPeriod($this->serializer->denormalize($period, RegionForecastPeriod::class));
      }, $data['forecast-period'], [$region]);
    }
    return $region;
  }

}
