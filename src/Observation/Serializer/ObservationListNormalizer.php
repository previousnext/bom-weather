<?php

declare(strict_types=1);

namespace BomWeather\Observation\Serializer;

use BomWeather\Observation\Observation;
use BomWeather\Observation\ObservationList;
use BomWeather\Util\BaseNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Normalizer for observations.
 */
class ObservationListNormalizer extends BaseNormalizer {

  /**
   * The supported interface or class.
   *
   * @var string|array<string>
   */
  protected string|array $supportedInterfaceOrClass = ObservationList::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize(mixed $data, string $type, ?string $format = NULL, array $context = []): mixed {
    if (!$this->serializer instanceof DenormalizerInterface) {
      throw new \RuntimeException('The serializer must implement the DenormalizerInterface.');
    }

    $observationList = new ObservationList();
    if (\array_key_exists('header', $data['observations'])) {
      $observationList->setRefreshMessage($data['observations']['header'][0]['refresh_message']);
    }

    \array_map(function ($observationData) use ($observationList): void {
      $observationList->addObservation($this->serializer->denormalize($observationData, Observation::class));
    }, $data['observations']['data'], [$observationList]);

    return $observationList;
  }

}
