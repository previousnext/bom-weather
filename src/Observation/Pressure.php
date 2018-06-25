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
  protected $pressureQnh;

  /**
   * The mean sea level pressure, in hectopascals.
   *
   * @var int
   */
  protected $pressureMsl;

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
  public function getPressureQnh(): ?int {
    return $this->pressureQnh;
  }

  /**
   * Sets the PressureQnh.
   *
   * @param int $pressureQnh
   *   The PressureQnh.
   *
   * @return $this
   */
  public function setPressureQnh(int $pressureQnh): Pressure {
    $this->pressureQnh = $pressureQnh;
    return $this;
  }

  /**
   * Gets the PressureMsl.
   *
   * @return int|null
   *   The PressureMsl.
   */
  public function getPressureMsl(): ?int {
    return $this->pressureMsl;
  }

  /**
   * Sets the PressureMsl.
   *
   * @param int $pressureMsl
   *   The PressureMsl.
   *
   * @return $this
   */
  public function setPressureMsl(int $pressureMsl): Pressure {
    $this->pressureMsl = $pressureMsl;
    return $this;
  }

}
