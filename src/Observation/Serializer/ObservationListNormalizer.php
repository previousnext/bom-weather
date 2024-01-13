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

  protected string|array $supportedInterfaceOrClass = ObservationList::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $type, $format = NULL, array $context = []) {
    if (!$this->serializer instanceof DenormalizerInterface) {
      throw new \RuntimeException('The serializer must implement the DenormalizerInterface.');
    }

    $observationList = new ObservationList();
    $observationList->setRefreshMessage($data['observations']['header'][0]['refresh_message']);

    \array_map(function ($observationData) use ($observationList): void {
      $observationList->addObservation($this->serializer->denormalize($observationData, Observation::class));
    }, $data['observations']['data'], [$observationList]);

    return $observationList;
  }

}
