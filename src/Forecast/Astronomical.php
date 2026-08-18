<?php

declare(strict_types=1);

namespace BomWeather\Forecast;

/**
 * Value object for astronomical data on a daily forecast period.
 */
final class Astronomical {

  /**
   * The sunrise time.
   */
  protected ?\DateTimeImmutable $sunriseTime = NULL;

  /**
   * The sunset time.
   */
  protected ?\DateTimeImmutable $sunsetTime = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $astronomical = new self();
    if (!empty($data['sunrise_time'])) {
      $astronomical->sunriseTime = new \DateTimeImmutable($data['sunrise_time']);
    }
    if (!empty($data['sunset_time'])) {
      $astronomical->sunsetTime = new \DateTimeImmutable($data['sunset_time']);
    }
    return $astronomical;
  }

  /**
   * Gets the sunrise time.
   */
  public function getSunriseTime(): ?\DateTimeImmutable {
    return $this->sunriseTime;
  }

  /**
   * Gets the sunset time.
   */
  public function getSunsetTime(): ?\DateTimeImmutable {
    return $this->sunsetTime;
  }

}
