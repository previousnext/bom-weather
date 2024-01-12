<?php

declare(strict_types = 1);

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\Area;
use BomWeather\Forecast\ForecastPeriod;
use BomWeather\Util\BaseNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Area normalizer.
 */
class AreaNormalizer extends BaseNormalizer {

  protected string|array $supportedInterfaceOrClass = Area::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $type, $format = NULL, array $context = []) {
    if (!$this->serializer instanceof DenormalizerInterface) {
      throw new \RuntimeException('The serializer must implement the DenormalizerInterface.');
    }

    $area = Area::create()
      ->setAac($data['@aac'])
      ->setType($data['@type'])
      ->setDescription($data['@description']);

    if (isset($data['@parent-aac'])) {
      $area->setParentAac($data['@parent-aac']);
    }

    if (isset($data['forecast-period'])) {
      if ($this->isAssoc($data['forecast-period'])) {
        $period = $data['forecast-period'];
        $area->addForecastPeriod($this->serializer->denormalize($period, ForecastPeriod::class));
      }
      else {
        \array_map(function ($period) use ($area): void {
          $area->addForecastPeriod($this->serializer->denormalize($period, ForecastPeriod::class));
        }, $data['forecast-period'], [$area]);

      }
    }
    return $area;
  }

}
