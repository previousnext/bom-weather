<?php

declare(strict_types=1);

namespace BomWeather\Observation;

/**
 * A value object for a value recorded at a point in time.
 */
final class TimedValue {

  /**
   * The time.
   */
  protected ?\DateTimeImmutable $time = NULL;

  /**
   * The value.
   */
  protected ?float $value = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $timedValue = new self();
    if (!empty($data['time'])) {
      $timedValue->time = new \DateTimeImmutable($data['time']);
    }
    $timedValue->value = $data['value'] ?? NULL;
    return $timedValue;
  }

  /**
   * Gets the time.
   */
  public function getTime(): ?\DateTimeImmutable {
    return $this->time;
  }

  /**
   * Gets the value.
   */
  public function getValue(): ?float {
    return $this->value;
  }

}
