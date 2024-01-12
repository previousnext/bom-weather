<?php

declare(strict_types = 1);

namespace BomWeather\Observation;

/**
 * A value object for temperature observations.
 */
final class Temperature {

  /**
   * The air temperature, in Celsius.
   */
  protected ?float $airTemp = NULL;

  /**
   * The apparent temperature, in Celsius.
   */
  protected ?float $apparentTemp = NULL;

  /**
   * The dew point, in Celsius.
   */
  protected ?float $dewPoint = NULL;

  /**
   * The relative humidity, as a percentage.
   */
  protected ?int $relativeHumidity = NULL;

  /**
   * The wet bulb depression, in Celsius.
   */
  protected ?float $deltaT = NULL;

  /**
   * Factory method.
   */
  public static function create(): Temperature {
    return new Temperature();
  }

  /**
   * Gets the AirTemp.
   */
  public function getAirTemp(): ?float {
    return $this->airTemp;
  }

  /**
   * Sets the AirTemp.
   */
  public function setAirTemp(float $airTemp): Temperature {
    $this->airTemp = $airTemp;
    return $this;
  }

  /**
   * Gets the ApparentTemp.
   */
  public function getApparentTemp(): ?float {
    return $this->apparentTemp;
  }

  /**
   * Sets the ApparentTemp.
   */
  public function setApparentTemp(float $apparentTemp): Temperature {
    $this->apparentTemp = $apparentTemp;
    return $this;
  }

  /**
   * Gets the DewPoint.
   */
  public function getDewPoint(): ?float {
    return $this->dewPoint;
  }

  /**
   * Sets the DewPoint.
   */
  public function setDewPoint(float $dewPoint): Temperature {
    $this->dewPoint = $dewPoint;
    return $this;
  }

  /**
   * Gets the RelativeHumidity.
   */
  public function getRelativeHumidity(): ?int {
    return $this->relativeHumidity;
  }

  /**
   * Sets the RelativeHumidity.
   */
  public function setRelativeHumidity(int $relativeHumidity): Temperature {
    $this->relativeHumidity = $relativeHumidity;
    return $this;
  }

  /**
   * Gets the DeltaT.
   */
  public function getDeltaT(): ?float {
    return $this->deltaT;
  }

  /**
   * Sets the DeltaT.
   */
  public function setDeltaT(float $deltaT): Temperature {
    $this->deltaT = $deltaT;
    return $this;
  }

}
