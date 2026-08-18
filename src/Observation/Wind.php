<?php

declare(strict_types=1);

namespace BomWeather\Observation;

/**
 * Value object for a wind or gust reading.
 */
final class Wind {

  /**
   * The wind speed, in kilometres per hour.
   */
  protected ?int $speedKilometre = NULL;

  /**
   * The wind speed, in knots.
   */
  protected ?int $speedKnot = NULL;

  /**
   * The wind direction, e.g. "N", "SSE".
   */
  protected ?string $direction = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $wind = new self();
    $wind->speedKilometre = $data['speed_kilometre'] ?? NULL;
    $wind->speedKnot = $data['speed_knot'] ?? NULL;
    $wind->direction = $data['direction'] ?? NULL;
    return $wind;
  }

  /**
   * Gets the wind speed, in kilometres per hour.
   */
  public function getSpeedKilometre(): ?int {
    return $this->speedKilometre;
  }

  /**
   * Gets the wind speed, in knots.
   */
  public function getSpeedKnot(): ?int {
    return $this->speedKnot;
  }

  /**
   * Gets the wind direction.
   */
  public function getDirection(): ?string {
    return $this->direction;
  }

}
