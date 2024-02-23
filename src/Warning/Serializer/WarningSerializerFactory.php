<?php

declare(strict_types=1);

namespace BomWeather\Warning\Serializer;

use BomWeather\Forecast\Serializer\AreaNormalizer;
use BomWeather\Forecast\Serializer\ForecastPeriodNormalizer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Factory for creating a weather warning data.
 */
class WarningSerializerFactory {

  /**
   * Creates a new forecast serializer.
   *
   * @param string $rootNode
   *   (optional) The root node of the XML.
   *
   * @return \Symfony\Component\Serializer\Serializer
   *   The serializer.
   */
  public static function create(string $rootNode = 'product'): Serializer {
    $encoders = [new XmlEncoder([XmlEncoder::ROOT_NODE_NAME => $rootNode])];
    $normalizers = [
      new DateTimeNormalizer([DateTimeNormalizer::TIMEZONE_KEY => 'UTC']),
      new WarningNormalizer(),
      new WarningInfoNormalizer(),
      new AreaNormalizer(),
      new ForecastPeriodNormalizer(),
    ];
    return new Serializer($normalizers, $encoders);
  }

}
