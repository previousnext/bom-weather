<?php

namespace BomWeather\Observation;

/**
 * A value object for temperature observations.
 */
class Temperature {

  /**
   * The air temperature, in celsius.
   *
   * @var float
   */
  protected $airTemp;

  /**
   * The apparent temperature, in celsius.
   *
   * @var float
   */
  protected $apparentTemp;

  /**
   * The dew point, in celsius.
   *
   * @var float
   */
  protected $dewPoint;

  /**
   * The relative humidity, as a percentage.
   *
   * @var int
   */
  protected $realtiveHumidity;

  /**
   * The wet bulb depression, in celsius.
   *
   * @var float
   */
  protected $deltaT;

  /**
   * Factory method.
   *
   * @return $this
   */
  public static function create() {
    return new static();
  }

  /**
   * Gets the AirTemp.
   *
   * @return float
   *   The AirTemp.
   */
  public function getAirTemp(): float {
    return $this->airTemp;
  }

  /**
   * Sets the AirTemp.
   *
   * @param float $airTemp
   *   The AirTemp.
   *
   * @return $this
   */
  public function setAirTemp(float $airTemp): Temperature {
    $this->airTemp = $airTemp;
    return $this;
  }

  /**
   * Gets the ApparentTemp.
   *
   * @return float
   *   The ApparentTemp.
   */
  public function getApparentTemp(): float {
    return $this->apparentTemp;
  }

  /**
   * Sets the ApparentTemp.
   *
   * @param float $apparentTemp
   *   The ApparentTemp.
   *
   * @return $this
   */
  public function setApparentTemp(float $apparentTemp): Temperature {
    $this->apparentTemp = $apparentTemp;
    return $this;
  }

  /**
   * Gets the DewPoint.
   *
   * @return float
   *   The DewPoint.
   */
  public function getDewPoint(): float {
    return $this->dewPoint;
  }

  /**
   * Sets the DewPoint.
   *
   * @param float $dewPoint
   *   The DewPoint.
   *
   * @return $this
   */
  public function setDewPoint(float $dewPoint): Temperature {
    $this->dewPoint = $dewPoint;
    return $this;
  }

  /**
   * Gets the RealtiveHumidity.
   *
   * @return int
   *   The RealtiveHumidity.
   */
  public function getRealtiveHumidity(): int {
    return $this->realtiveHumidity;
  }

  /**
   * Sets the RealtiveHumidity.
   *
   * @param int $realtiveHumidity
   *   The RealtiveHumidity.
   *
   * @return $this
   */
  public function setRealtiveHumidity(int $realtiveHumidity): Temperature {
    $this->realtiveHumidity = $realtiveHumidity;
    return $this;
  }

  /**
   * Gets the DeltaT.
   *
   * @return float
   *   The DeltaT.
   */
  public function getDeltaT(): float {
    return $this->deltaT;
  }

  /**
   * Sets the DeltaT.
   *
   * @param float $deltaT
   *   The DeltaT.
   *
   * @return $this
   */
  public function setDeltaT(float $deltaT): Temperature {
    $this->deltaT = $deltaT;
    return $this;
  }

}
