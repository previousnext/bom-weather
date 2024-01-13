<?php

declare(strict_types=1);

namespace BomWeather\Observation\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * A factory for observation serializers.
 */
class ObservationSerializerFactory {

  /**
   * Creates a new forecast serializer.
   *
   * @return \Symfony\Component\Serializer\Serializer
   *   The serializer.
   */
  public static function create(): Serializer {
    $encoders = [new JsonEncoder()];
    $normalizers = [
      new ObservationListNormalizer(),
      new ObservationNormalizer(),
      new DateTimeNormalizer([DateTimeNormalizer::TIMEZONE_KEY => 'UTC']),
      new GetSetMethodNormalizer(),
    ];
    return new Serializer($normalizers, $encoders);
  }

}
