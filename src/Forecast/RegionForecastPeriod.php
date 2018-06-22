<?php

namespace BomWeather\Forecast;

/**
 * Value object for region forecast data.
 */
class RegionForecastPeriod extends ForecastPeriod {

  /**
   * The synoptic situation.
   *
   * @var string
   */
  protected $synoptic;

  /**
   * The forecast.
   *
   * @var string
   */
  protected $forecast;

  /**
   * Factory method.
   *
   * @return $this
   */
  public static function create() {
    return new static();
  }

  /**
   * Gets the synoptic.
   *
   * @return string
   *   The synoptic.
   */
  public function getSynoptic(): string {
    return $this->synoptic;
  }

  /**
   * Sets the synoptic.
   *
   * @param string $synoptic
   *   The synoptic.
   *
   * @return $this
   */
  public function setSynoptic(string $synoptic): RegionForecastPeriod {
    $this->synoptic = $synoptic;
    return $this;
  }

  /**
   * Gets the forecast.
   *
   * @return string
   *   The forecast.
   */
  public function getForecast(): ?string {
    return $this->forecast;
  }

  /**
   * Sets the forecast.
   *
   * @param string $forecast
   *   The forecast.
   *
   * @return $this
   */
  public function setForecast(string $forecast): RegionForecastPeriod {
    $this->forecast = $forecast;
    return $this;
  }

}
