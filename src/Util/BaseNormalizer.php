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
   *
   * @return array<string, mixed>|\ArrayObject<string, mixed>|bool|float|int|string|null
   *   The normalized data.
   */
  public function normalize(mixed $object, ?string $format = NULL, array $context = []): array|\ArrayObject|bool|float|int|string|null {
    throw new \RuntimeException("Method not implemented.");
  }

  /**
   * Checks whether the array is associative.
   *
   * @param array<mixed> $array
   *   The array.
   *
   * @return bool
   *   TRUE if the array is associative.
   */
  protected function isAssoc(array $array): bool {
    return (bool) \count(\array_filter(\array_keys($array), 'is_string'));
  }

}
