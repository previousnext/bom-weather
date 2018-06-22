<?php

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\MetropolitanArea;
use BomWeather\Forecast\MetropolitanForecastPeriod;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Metropolitan area normalizer.
 */
class MetropolitanNormalizer extends BaseNormalizer {

  protected $supportedInterfaceOrClass = MetropolitanArea::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $class, $format = NULL, array $context = []) {

    if (!$this->serializer instanceof DenormalizerInterface) {
      throw new \RuntimeException('The serializer must implement the DenormalizerInterface.');
    }

    $metroArea = MetropolitanArea::create()
      ->setAac($data['@aac'])
      ->setDescription($data['@description']);

    array_map(function ($period) use ($metroArea) {
      $metroArea->addForecastPeriod($this->serializer->denormalize($period, MetropolitanForecastPeriod::class));
    }, $data['forecast-period'], [$metroArea]);

    return $metroArea;
  }

}
