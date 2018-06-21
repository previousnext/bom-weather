<?php

namespace BomWeather\Forecast;

/**
 * Location forecast period.
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

}
