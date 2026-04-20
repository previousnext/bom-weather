<?php

declare(strict_types=1);

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\Area;
use BomWeather\Forecast\ForecastPeriod;
use BomWeather\Util\BaseNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Area normalizer.
 */
class AreaNormalizer extends BaseNormalizer {

  /**
   * The supported interface or class.
   *
   * @var string|array<string>
   */
  protected string|array $supportedInterfaceOrClass = Area::class;

  /**
   * {@inheritdoc}
   *
   * @param mixed $data
   *   Data to restore.
   * @param string $type
   *   The expected class to instantiate.
   * @param string|null $format
   *   Format the given data was extracted from.
   * @param array<string, mixed> $context
   *   Context options for the denormalizer.
   */
  public function denormalize(mixed $data, string $type, ?string $format = NULL, array $context = []): mixed {
    if (!$this->serializer instanceof DenormalizerInterface) {
      throw new \RuntimeException('The serializer must implement the DenormalizerInterface.');
    }

    $area = (new Area())
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
