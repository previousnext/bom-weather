<?php

declare(strict_types=1);

namespace BomWeather\Warning\Serializer;

use BomWeather\Forecast\Area;
use BomWeather\Util\BaseNormalizer;
use BomWeather\Warning\Warning;
use BomWeather\Warning\WarningInfo;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Forecast normalizer.
 */
class WarningNormalizer extends BaseNormalizer {

  protected string|array $supportedInterfaceOrClass = Warning::class;

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

    $warning = (new Warning())
      ->setIssueTime($this->serializer->denormalize($data['amoc']['issue-time-utc'], \DateTimeImmutable::class));

    if (\array_key_exists('warning', $data)) {
      if ($this->isAssoc($data['warning']['area'])) {
        $area = $data['warning']['area'];
        $this->setValue($area, $warning);
      }
      else {
        \array_map(function ($area) use ($warning): void {
          $this->setValue($area, $warning);
        }, $data['warning']['area'], [$warning]);
      }
      $warningInfo = $this->serializer->denormalize($data['warning']['warning-info'], WarningInfo::class);
      $warning->setWarningInfo($warningInfo);
    }

    return $warning;
  }

  /**
   * Sets the area value.
   *
   * @param array<string, mixed> $area
   *   The area data.
   * @param \BomWeather\Warning\Warning $warning
   *   The warning.
   */
  public function setValue(array $area, Warning $warning): void {
    switch ($area['@type']) {
      case Area::TYPE_REGION:
        $warning->addRegion($this->serializer->denormalize($area, Area::class));
        break;

      case Area::TYPE_DISTRICT:
        $warning->addDistrict($this->serializer->denormalize($area, Area::class));
        break;

      case Area::TYPE_METROPOLITAN:
        $warning->addMetropolitanArea($this->serializer->denormalize($area, Area::class));
        break;

      case Area::TYPE_LOCATION:
        $warning->addLocation($this->serializer->denormalize($area, Area::class));
        break;

      case Area::TYPE_COAST:
        $warning->addCoast($this->serializer->denormalize($area, Area::class));
        break;
    }
  }

}
