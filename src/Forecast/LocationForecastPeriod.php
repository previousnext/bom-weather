<?php

namespace BomWeather\Forecast;

/**
 * Value object for location forecast data.
 */
class LocationForecastPeriod extends ForecastPeriod {

  /**
   * The forecast icon code.
   *
   * @var int
   */
  protected $iconCode;

  /**
   * The precipitation range.
   *
   * @var string
   */
  protected $precipitationRange;

  /**
   * The air temp minimum in Celsius.
   *
   * @var int
   */
  protected $airTempMinimum;

  /**
   * The air temp maximum in Celsius.
   *
   * @var int
   */
  protected $airTempMaximum;

  /**
   * The precis.
   *
   * @var string
   */
  protected $precis;

  /**
   * The probability of precipitation.
   *
   * @var string
   */
  protected $probabilityOfPrecipitation;

  /**
   * Factory method.
   *
   * @return $this
   */
  public static function create() {
    return new static();
  }

  /**
   * Gets the icon code.
   *
   * @return int
   *   The icon code.
   */
  public function getIconCode(): int {
    return $this->iconCode;
  }

  /**
   * Sets the icon code.
   *
   * @param int $iconCode
   *   The icon code.
   *
   * @return $this
   */
  public function setIconCode(int $iconCode): LocationForecastPeriod {
    $this->iconCode = $iconCode;
    return $this;
  }

  /**
   * Gets the precipitation range.
   *
   * @return string
   *   The precipitation range.
   */
  public function getPrecipitationRange(): string {
    return $this->precipitationRange;
  }

  /**
   * Sets the precipitation range.
   *
   * @param string $precipitationRange
   *   The precipitation range.
   *
   * @return $this
   */
  public function setPrecipitationRange(string $precipitationRange
  ): LocationForecastPeriod {
    $this->precipitationRange = $precipitationRange;
    return $this;
  }

  /**
   * Gets the air temp minimum.
   *
   * @return int
   *   The air temp minimum.
   */
  public function getAirTempMinimum(): int {
    return $this->airTempMinimum;
  }

  /**
   * Sets the air temp minimum.
   *
   * @param int $airTempMinimum
   *   The air temp minimum.
   *
   * @return $this
   */
  public function setAirTempMinimum(int $airTempMinimum): LocationForecastPeriod {
    $this->airTempMinimum = $airTempMinimum;
    return $this;
  }

  /**
   * Gets the air temp maximum.
   *
   * @return int
   *   The air temp maximum.
   */
  public function getAirTempMaximum(): int {
    return $this->airTempMaximum;
  }

  /**
   * Sets the air temp maximum.
   *
   * @param int $airTempMaximum
   *   The air temp maximum.
   *
   * @return $this
   */
  public function setAirTempMaximum(int $airTempMaximum): LocationForecastPeriod {
    $this->airTempMaximum = $airTempMaximum;
    return $this;
  }

  /**
   * Gets the precis.
   *
   * @return string
   *   The precis.
   */
  public function getPrecis(): string {
    return $this->precis;
  }

  /**
   * Sets the precis.
   *
   * @param string $precis
   *   The precis.
   *
   * @return $this
   */
  public function setPrecis(string $precis): LocationForecastPeriod {
    $this->precis = $precis;
    return $this;
  }

  /**
   * Gets the probability of precipitation.
   *
   * @return string
   *   The probability of precipitation.
   */
  public function getProbabilityOfPrecipitation(): string {
    return $this->probabilityOfPrecipitation;
  }

  /**
   * Sets the probability of precipitation.
   *
   * @param string $probabilityOfPrecipitation
   *   The probability of precipitation.
   *
   * @return $this
   */
  public function setProbabilityOfPrecipitation(string $probabilityOfPrecipitation): LocationForecastPeriod {
    $this->probabilityOfPrecipitation = $probabilityOfPrecipitation;
    return $this;
  }

}
