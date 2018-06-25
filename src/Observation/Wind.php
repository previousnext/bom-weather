<?php

namespace BomWeather\Observation;

/**
 * Value object for a wind observation.
 */
class Wind {

  /**
   * The wind direction.
   *
   * @var string
   */
  protected $direction;

  /**
   * The wind speed, in kilometres per Hour.
   *
   * @var int
   */
  protected $speedKmh;

  /**
   * The wind gusts, in kilometres per Hour.
   *
   * @var int
   */
  protected $gustKmh;


  /**
   * The wind speed, in knots.
   *
   * @var int
   */
  protected $speedKnots;

  /**
   * The wind gusts, in knots.
   *
   * @var int
   */
  protected $gustKnots;

  /**
   * Factory method.
   *
   * @return $this
   */
  public static function create() {
    return new static();
  }

  /**
   * Gets the Direction.
   *
   * @return string
   *   The Direction.
   */
  public function getDirection(): string {
    return $this->direction;
  }

  /**
   * Sets the Direction.
   *
   * @param string $direction
   *   The Direction.
   *
   * @return $this
   */
  public function setDirection(string $direction): Wind {
    $this->direction = $direction;
    return $this;
  }

  /**
   * Gets the Speed, in kilometres per hour.
   *
   * @return int
   *   The SpeedKmh.
   */
  public function getSpeedKmh(): int {
    return $this->speedKmh;
  }

  /**
   * Sets the Speed, in kilometres per hour.
   *
   * @param int $speedKmh
   *   The SpeedKmh.
   *
   * @return $this
   */
  public function setSpeedKmh(int $speedKmh): Wind {
    $this->speedKmh = $speedKmh;
    return $this;
  }

  /**
   * Gets the Gust, in kilometres per hour.
   *
   * @return int
   *   The GustKmh.
   */
  public function getGustKmh(): int {
    return $this->gustKmh;
  }

  /**
   * Sets the Gust, in kilometres per hour.
   *
   * @param int $gustKmh
   *   The GustKmh.
   *
   * @return $this
   */
  public function setGustKmh(int $gustKmh): Wind {
    $this->gustKmh = $gustKmh;
    return $this;
  }

  /**
   * Gets the Speed, in knots.
   *
   * @return int
   *   The SpeedKnots.
   */
  public function getSpeedKnots(): int {
    return $this->speedKnots;
  }

  /**
   * Sets the Speed, in knots.
   *
   * @param int $speedKnots
   *   The SpeedKnots.
   *
   * @return $this
   */
  public function setSpeedKnots(int $speedKnots): Wind {
    $this->speedKnots = $speedKnots;
    return $this;
  }

  /**
   * Gets the Gust, in knots.
   *
   * @return int
   *   The GustsKnots.
   */
  public function getGustKnots(): int {
    return $this->gustKnots;
  }

  /**
   * Sets the Gust, in knots.
   *
   * @param int $gustKnots
   *   The GustsKnots.
   *
   * @return $this
   */
  public function setGustKnots(int $gustKnots): Wind {
    $this->gustKnots = $gustKnots;
    return $this;
  }

}
