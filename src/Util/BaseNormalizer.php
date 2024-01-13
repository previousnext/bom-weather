<?php

declare(strict_types=1);

namespace BomWeather\Util;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * The base serializer.
 */
abstract class BaseNormalizer extends AbstractNormalizer {

  use ClassNameSupportNormalizerTrait;

  /**
   * {@inheritdoc}
   */
  public function normalize(mixed $object, string $format = NULL, array $context = []) {
    throw new \RuntimeException("Method not implemented.");
  }

  /**
   * Checks whether the array is associative.
   *
   * @param array $array
   *   The array.
   *
   * @return bool
   *   TRUE if the array is associative.
   */
  protected function isAssoc(array $array): bool {
    return (bool) \count(\array_filter(\array_keys($array), 'is_string'));
  }

}
