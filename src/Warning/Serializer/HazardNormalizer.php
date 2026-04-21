<?php

declare(strict_types=1);

namespace BomWeather\Warning\Serializer;

use BomWeather\Forecast\Area;
use BomWeather\Util\BaseNormalizer;
use BomWeather\Warning\Hazard;
use BomWeather\Warning\HazardCertainty;
use BomWeather\Warning\HazardSeverity;
use BomWeather\Warning\HazardUrgency;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Hazard normalizer.
 */
class HazardNormalizer extends BaseNormalizer {

  /**
   * The supported interface or class.
   *
   * @var string|array<string>
   */
  protected string|array $supportedInterfaceOrClass = Hazard::class;

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

    $hazard = new Hazard();

    // Parse attributes.
    if (isset($data['@type'])) {
      $hazard->setType($data['@type']);
    }
    if (isset($data['@severity'])) {
      $hazard->setSeverity(HazardSeverity::tryFrom($data['@severity']) ?? HazardSeverity::Unknown);
    }
    if (isset($data['@urgency'])) {
      $hazard->setUrgency(HazardUrgency::tryFrom($data['@urgency']) ?? HazardUrgency::Unknown);
    }
    if (isset($data['@certainty'])) {
      $hazard->setCertainty(HazardCertainty::tryFrom($data['@certainty']) ?? HazardCertainty::Unknown);
    }

    // Parse priority.
    if (isset($data['priority'])) {
      $hazard->setPriority($data['priority']);
    }

    // Parse area-list.
    if (isset($data['area-list']['area'])) {
      $areas = $data['area-list']['area'];
      if ($this->isAssoc($areas)) {
        $hazard->addAffectedArea($this->serializer->denormalize($areas, Area::class));
      }
      else {
        foreach ($areas as $area) {
          $hazard->addAffectedArea($this->serializer->denormalize($area, Area::class));
        }
      }
    }

    // Parse text elements.
    if (isset($data['text'])) {
      $texts = $data['text'];
      if ($this->isAssoc($texts)) {
        $this->setTextValue($texts, $hazard);
      }
      else {
        foreach ($texts as $text) {
          $this->setTextValue($text, $hazard);
        }
      }
    }

    return $hazard;
  }

  /**
   * Sets a text value on the hazard.
   *
   * @param array<string, mixed> $text
   *   The text array.
   * @param \BomWeather\Warning\Hazard $hazard
   *   The hazard.
   */
  protected function setTextValue(array $text, Hazard $hazard): void {
    $value = $text['#'] ?? NULL;
    if ($value === NULL) {
      return;
    }

    match ($text['@type'] ?? NULL) {
      'warning_phenomena' => $hazard->setPhenomena($value),
      'warning_areas' => $hazard->setAreas($value),
      default => NULL,
    };
  }

}
