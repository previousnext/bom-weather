<?php

declare(strict_types=1);

namespace BomWeather\Warning\Serializer;

use BomWeather\Forecast\Area;
use BomWeather\Forecast\Forecast;
use BomWeather\Util\BaseNormalizer;
use BomWeather\Warning\Warning;
use BomWeather\Warning\WarningInfo;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Forecast normalizer.
 */
class WarningInfoNormalizer extends BaseNormalizer {

  /**
   * {@inheritdoc}
   */
  protected string|array $supportedInterfaceOrClass = WarningInfo::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $type, $format = NULL, array $context = []) {
    if (!$this->serializer instanceof DenormalizerInterface) {
      throw new \RuntimeException('The serializer must implement the DenormalizerInterface.');
    }

    $warningInfo = (new WarningInfo());


    return $warningInfo;
  }

}
