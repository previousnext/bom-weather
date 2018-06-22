<?php

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\Area;
use BomWeather\Forecast\Forecast;
use BomWeather\Forecast\Location;
use BomWeather\Forecast\MetropolitanArea;
use BomWeather\Forecast\Region;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Forecast normalizer.
 */
class ForecastNormalizer extends BaseNormalizer {

  /**
   * {@inheritdoc}
   */
  protected $supportedInterfaceOrClass = Forecast::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $class, $format = NULL, array $context = []) {
    if (!$this->serializer instanceof DenormalizerInterface) {
      throw new \RuntimeException('The serializer must implement the DenormalizerInterface.');
    }

    $forecast = Forecast::create()
      ->setIssueTime($this->serializer->denormalize($data['amoc']['issue-time-utc'], \DateTime::class));

    array_map(function ($area) use ($forecast) {

      switch ($area['@type']) {
        case Area::TYPE_REGION:
          $forecast->addRegion($this->serializer->denormalize($area, Region::class));
          break;

        case Area::TYPE_METROPOLITAN:
          $forecast->addMetropolitanArea($this->serializer->denormalize($area, MetropolitanArea::class));
          break;

        case Area::TYPE_LOCATION:
          $forecast->addLocation($this->serializer->denormalize($area, Location::class));
          break;

      };
    }, $data['forecast']['area'], [$forecast]);

    return $forecast;
  }

}
