<?php

declare(strict_types = 1);

namespace BomWeather\Observation;

/**
 * Value object for a wind observation.
 */
final class Wind {

  /**
   * The wind direction.
   */
  protected ?string $direction = NULL;

  /**
   * The wind speed, in kilometres per Hour.
   */
  protected ?int $speedKmh = NULL;

  /**
   * The wind gusts, in kilometres per Hour.
   */
  protected ?int $gustKmh = NULL;

  /**
   * The wind speed, in knots.
   */
  protected ?int $speedKnots = NULL;

  /**
   * The wind gusts, in knots.
   */
  protected ?int $gustKnots = NULL;

  /**
   * Factory method.
   *
   * @return $this
   */
  public static function create(): Wind {
    return new Wind();
  }

  /**
   * Gets the Direction.
   */
  public function getDirection(): ?string {
    return $this->direction;
  }

  /**
   * Sets the Direction.
   */
  public function setDirection(string $direction): Wind {
    $this->direction = $direction;
    return $this;
  }

  /**
   * Gets the Speed, in kilometres per hour.
   */
  public function getSpeedKmh(): ?int {
    return $this->speedKmh;
  }

  /**
   * Sets the Speed, in kilometres per hour.
   */
  public function setSpeedKmh(int $speedKmh): Wind {
    $this->speedKmh = $speedKmh;
    return $this;
  }

  /**
   * Gets the Gust, in kilometres per hour.
   */
  public function getGustKmh(): ?int {
    return $this->gustKmh;
  }

  /**
   * Sets the Gust, in kilometres per hour.
   */
  public function setGustKmh(int $gustKmh): Wind {
    $this->gustKmh = $gustKmh;
    return $this;
  }

  /**
   * Gets the Speed, in knots.
   */
  public function getSpeedKnots(): ?int {
    return $this->speedKnots;
  }

  /**
   * Sets the Speed, in knots.
   */
  public function setSpeedKnots(int $speedKnots): Wind {
    $this->speedKnots = $speedKnots;
    return $this;
  }

  /**
   * Gets the Gust, in knots.
   */
  public function getGustKnots(): ?int {
    return $this->gustKnots;
  }

  /**
   * Sets the Gust, in knots.
   */
  public function setGustKnots(int $gustKnots): Wind {
    $this->gustKnots = $gustKnots;
    return $this;
  }

}
