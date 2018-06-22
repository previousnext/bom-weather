<?php

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\Area;
use BomWeather\Forecast\Forecast;
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

    if ($this->isAssoc($data['forecast']['area'])) {
      $area = $data['forecast']['area'];
      $this->setValue($area, $forecast);
    }
    else {
      array_map(function ($area) use ($forecast) {

        $this->setValue($area, $forecast);
      }, $data['forecast']['area'], [$forecast]);
    }
    return $forecast;
  }

  /**
   * Sets the area value.
   *
   * @param array $area
   *   The area data.
   * @param \BomWeather\Forecast\Forecast $forecast
   *   The forecast.
   */
  public function setValue(array $area, Forecast $forecast): void {
    switch ($area['@type']) {
      case Area::TYPE_REGION:
        $forecast->addRegion($this->serializer->denormalize($area, Area::class));
        break;

      case Area::TYPE_DISTRICT:
        $forecast->addDistrict($this->serializer->denormalize($area, Area::class));
        break;

      case Area::TYPE_METROPOLITAN:
        $forecast->addMetropolitanArea($this->serializer->denormalize($area, Area::class));
        break;

      case Area::TYPE_LOCATION:
        $forecast->addLocation($this->serializer->denormalize($area, Area::class));
        break;

      case Area::TYPE_COAST:
        $forecast->addCoast($this->serializer->denormalize($area, Area::class));
        break;
    };
  }

}
