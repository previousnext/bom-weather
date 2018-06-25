<?php

namespace BomWeather\Observation;

/**
 * A value object for pressure observations.
 */
class Pressure {

  /**
   * The QNH pressure, in hectopascals.
   *
   * @var int
   */
  protected $qnh;

  /**
   * The mean sea level pressure, in hectopascals.
   *
   * @var int
   */
  protected $meanSeaLevel;

  /**
   * Factory method.
   *
   * @return $this
   */
  public static function create() {
    return new static();
  }

  /**
   * Gets the PressureQnh.
   *
   * @return int
   *   The PressureQnh.
   */
  public function getQnh(): ?int {
    return $this->qnh;
  }

  /**
   * Sets the PressureQnh.
   *
   * @param int $qnh
   *   The PressureQnh.
   *
   * @return $this
   */
  public function setQnh(int $qnh): Pressure {
    $this->qnh = $qnh;
    return $this;
  }

  /**
   * Gets the PressureMsl.
   *
   * @return int|null
   *   The PressureMsl.
   */
  public function getMeanSeaLevel(): ?int {
    return $this->meanSeaLevel;
  }

  /**
   * Sets the PressureMsl.
   *
   * @param int $meanSeaLevel
   *   The PressureMsl.
   *
   * @return $this
   */
  public function setMeanSeaLevel(int $meanSeaLevel): Pressure {
    $this->meanSeaLevel = $meanSeaLevel;
    return $this;
  }

}
