<?php

declare(strict_types=1);

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\Area;
use BomWeather\Forecast\Forecast;
use BomWeather\Util\BaseNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Forecast normalizer.
 */
class ForecastNormalizer extends BaseNormalizer {

  /**
   * The supported interface or class.
   *
   * @var string|array<string>
   */
  protected string|array $supportedInterfaceOrClass = Forecast::class;

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

    $forecast = (new Forecast())
      ->setIssueTime($this->serializer->denormalize($data['amoc']['issue-time-utc'], \DateTimeImmutable::class));

    if ($this->isAssoc($data['forecast']['area'])) {
      $area = $data['forecast']['area'];
      $this->setValue($area, $forecast);
    }
    else {
      \array_map(function ($area) use ($forecast): void {
        $this->setValue($area, $forecast);
      }, $data['forecast']['area'], [$forecast]);
    }
    return $forecast;
  }

  /**
   * Sets the area value.
   *
   * @param array<string, mixed> $area
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
    }
  }

}
