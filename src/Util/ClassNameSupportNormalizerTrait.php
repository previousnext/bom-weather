<?php

declare(strict_types = 1);

namespace BomWeather\Util;

/**
 * Provides support for checking a class name for normalization support.
 */
trait ClassNameSupportNormalizerTrait {

  /**
   * The interface or class that this Normalizer supports.
   */
  protected string|array $supportedInterfaceOrClass;

  /**
   * The format this Normalizer supports.
   */
  protected string|array $format;

  /**
   * Gets the string or array of supported classes.
   */
  public function getSupportedInterfaceOrClass(): string|array {
    return $this->supportedInterfaceOrClass;
  }

  /**
   * Sets the string or array of supported classes.
   */
  public function setSupportedInterfaceOrClass(string|array $supported_interface_or_class): self {
    $this->supportedInterfaceOrClass = $supported_interface_or_class;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function supportsNormalization(mixed $data, string $format = NULL /* , array $context = [] */): bool {
    // If we aren't dealing with an object or the format is not supported return
    // now.
    if (!\is_object($data) || !$this->checkFormat($format)) {
      return FALSE;
    }

    $supported = (array) $this->supportedInterfaceOrClass;

    return (bool) \array_filter($supported, function ($name) use ($data) {
      return $data instanceof $name;
    });
  }

  /**
   * {@inheritdoc}
   */
  public function supportsDenormalization(mixed $data, string $type, string $format = NULL /* , array $context = [] */): bool {
    // If the format is not supported return now.
    if (!$this->checkFormat($format)) {
      return FALSE;
    }

    $supported = (array) $this->supportedInterfaceOrClass;

    $subclass_check = function ($name) use ($type) {
      return (\class_exists($name) || \interface_exists($name)) && \is_subclass_of($type,
          $name, TRUE);
    };

    return \in_array($type, $supported) || \array_filter($supported,
        $subclass_check);
  }

  /**
   * Checks if the provided format is supported by this serializer.
   *
   * @return bool
   *   TRUE if the format is supported, FALSE otherwise. If no format is
   *   specified this will return TRUE.
   */
  protected function checkFormat(string $format = NULL): bool {
    if (!isset($format) || !isset($this->format)) {
      return TRUE;
    }

    return \in_array($format, (array) $this->format);
  }

}
