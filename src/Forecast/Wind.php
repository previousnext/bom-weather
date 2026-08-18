<?php

declare(strict_types=1);

namespace BomWeather\Forecast;

/**
 * Value object for the wind forecast on an hourly forecast period.
 */
final class Wind {

  /**
   * The wind speed, in knots.
   */
  protected ?int $speedKnot = NULL;

  /**
   * The wind speed, in kilometres per hour.
   */
  protected ?int $speedKilometre = NULL;

  /**
   * The wind direction, e.g. "N", "SSE".
   */
  protected ?string $direction = NULL;

  /**
   * The gust speed, in knots.
   */
  protected ?int $gustSpeedKnot = NULL;

  /**
   * The gust speed, in kilometres per hour.
   */
  protected ?int $gustSpeedKilometre = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $wind = new self();
    $wind->speedKnot = $data['speed_knot'] ?? NULL;
    $wind->speedKilometre = $data['speed_kilometre'] ?? NULL;
    $wind->direction = $data['direction'] ?? NULL;
    $wind->gustSpeedKnot = $data['gust_speed_knot'] ?? NULL;
    $wind->gustSpeedKilometre = $data['gust_speed_kilometre'] ?? NULL;
    return $wind;
  }

  /**
   * Gets the wind speed, in knots.
   */
  public function getSpeedKnot(): ?int {
    return $this->speedKnot;
  }

  /**
   * Gets the wind speed, in kilometres per hour.
   */
  public function getSpeedKilometre(): ?int {
    return $this->speedKilometre;
  }

  /**
   * Gets the wind direction.
   */
  public function getDirection(): ?string {
    return $this->direction;
  }

  /**
   * Gets the gust speed, in knots.
   */
  public function getGustSpeedKnot(): ?int {
    return $this->gustSpeedKnot;
  }

  /**
   * Gets the gust speed, in kilometres per hour.
   */
  public function getGustSpeedKilometre(): ?int {
    return $this->gustSpeedKilometre;
  }

}
