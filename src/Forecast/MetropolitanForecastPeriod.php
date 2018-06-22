<?php

namespace BomWeather\Forecast;

/**
 * Value object for metropolitan forecast data.
 */
class MetropolitanForecastPeriod extends ForecastPeriod {

  /**
   * The forecast.
   *
   * @var string
   */
  protected $forecast;

  /**
   * The UV alert.
   *
   * @var string
   */
  protected $uvAlert;

  /**
   * Factory method.
   *
   * @return $this
   */
  public static function create() {
    return new static();
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
  public function setForecast(string $forecast): MetropolitanForecastPeriod {
    $this->forecast = $forecast;
    return $this;
  }

  /**
   * Gets the UV alert.
   *
   * @return string
   *   The UV alert.
   */
  public function getUvAlert(): string {
    return $this->uvAlert;
  }

  /**
   * Sets the UV alert.
   *
   * @param string $uvAlert
   *   The UV alert.
   *
   * @return $this
   */
  public function setUvAlert(string $uvAlert): MetropolitanForecastPeriod {
    $this->uvAlert = $uvAlert;
    return $this;
  }

}
