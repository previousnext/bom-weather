<?php

declare(strict_types=1);

namespace BomWeather\Forecast;

/**
 * A value object for forecast periods.
 */
final class ForecastPeriod {

  /**
   * The start time.
   */
  protected ?\DateTimeImmutable $startTime = NULL;

  /**
   * The end time.
   */
  protected ?\DateTimeImmutable $endTime = NULL;

  /**
   * The air temp maximum in Celsius.
   */
  protected ?int $airTempMaximum = NULL;

  /**
   * The probability of precipitation.
   */
  protected ?string $probabilityOfPrecipitation = NULL;

  /**
   * The precipitation range.
   */
  protected ?string $precipitationRange = NULL;

  /**
   * The forecast icon code.
   */
  protected ?string $iconCode = NULL;

  /**
   * The air temp minimum in Celsius.
   */
  protected ?int $airTempMinimum = NULL;

  /**
   * The precis.
   */
  protected ?string $precis = NULL;

  /**
   * The UV alert.
   */
  protected ?string $uvAlert = NULL;

  /**
   * The forecast.
   */
  protected ?string $forecast = NULL;

  /**
   * The synoptic situation.
   */
  protected ?string $synoptic = NULL;

  /**
   * The seas.
   */
  protected ?string $seas = NULL;

  /**
   * The swell.
   */
  protected ?string $swell = NULL;

  /**
   * The weather.
   */
  protected ?string $weather = NULL;

  /**
   * The winds.
   */
  protected ?string $winds = NULL;

  /**
   * Gets the start time.
   */
  public function getStartTime(): ?\DateTimeImmutable {
    return $this->startTime;
  }

  /**
   * Sets the start time.
   */
  public function setStartTime(\DateTimeImmutable $startTime): ForecastPeriod {
    $this->startTime = $startTime;
    return $this;
  }

  /**
   * Gets the end time.
   */
  public function getEndTime(): ?\DateTimeImmutable {
    return $this->endTime;
  }

  /**
   * Sets the end time.
   */
  public function setEndTime(\DateTimeImmutable $endTime): ForecastPeriod {
    $this->endTime = $endTime;
    return $this;
  }

  /**
   * Gets the icon code.
   */
  public function getIconCode(): ?string {
    return $this->iconCode;
  }

  /**
   * Sets the icon code.
   */
  public function setIconCode(string $iconCode): ForecastPeriod {
    $this->iconCode = $iconCode;
    return $this;
  }

  /**
   * Gets the precipitation range.
   */
  public function getPrecipitationRange(): ?string {
    return $this->precipitationRange;
  }

  /**
   * Sets the precipitation range.
   */
  public function setPrecipitationRange(string $precipitationRange): ForecastPeriod {
    $this->precipitationRange = $precipitationRange;
    return $this;
  }

  /**
   * Gets the air temp minimum.
   */
  public function getAirTempMinimum(): ?int {
    return $this->airTempMinimum;
  }

  /**
   * Sets the air temp minimum.
   */
  public function setAirTempMinimum(int $airTempMinimum): ForecastPeriod {
    $this->airTempMinimum = $airTempMinimum;
    return $this;
  }

  /**
   * Gets the air temp maximum.
   */
  public function getAirTempMaximum(): ?int {
    return $this->airTempMaximum;
  }

  /**
   * Sets the air temp maximum.
   */
  public function setAirTempMaximum(int $airTempMaximum): ForecastPeriod {
    $this->airTempMaximum = $airTempMaximum;
    return $this;
  }

  /**
   * Gets the precis.
   */
  public function getPrecis(): ?string {
    return $this->precis;
  }

  /**
   * Sets the precis.
   */
  public function setPrecis(string $precis): ForecastPeriod {
    $this->precis = $precis;
    return $this;
  }

  /**
   * Gets the probability of precipitation.
   */
  public function getProbabilityOfPrecipitation(): ?string {
    return $this->probabilityOfPrecipitation;
  }

  /**
   * Sets the probability of precipitation.
   */
  public function setProbabilityOfPrecipitation(
    string $probabilityOfPrecipitation
  ): ForecastPeriod {
    $this->probabilityOfPrecipitation = $probabilityOfPrecipitation;
    return $this;
  }

  /**
   * Gets the forecast.
   */
  public function getForecast(): ?string {
    return $this->forecast;
  }

  /**
   * Sets the forecast.
   */
  public function setForecast(?string $forecast): ForecastPeriod {
    $this->forecast = $forecast;
    return $this;
  }

  /**
   * Gets the UV alert.
   */
  public function getUvAlert(): ?string {
    return $this->uvAlert;
  }

  /**
   * Sets the UV alert.
   */
  public function setUvAlert(string $uvAlert): ForecastPeriod {
    $this->uvAlert = $uvAlert;
    return $this;
  }

  /**
   * Gets the synoptic.
   */
  public function getSynoptic(): ?string {
    return $this->synoptic;
  }

  /**
   * Sets the synoptic.
   */
  public function setSynoptic(string $synoptic): ForecastPeriod {
    $this->synoptic = $synoptic;
    return $this;
  }

  /**
   * Gets the seas.
   */
  public function getSeas(): ?string {
    return $this->seas;
  }

  /**
   * Sets the seas.
   */
  public function setSeas(string $seas): ForecastPeriod {
    $this->seas = $seas;
    return $this;
  }

  /**
   * Gets the swell.
   */
  public function getSwell(): ?string {
    return $this->swell;
  }

  /**
   * Sets the swell.
   */
  public function setSwell(string $swell): ForecastPeriod {
    $this->swell = $swell;
    return $this;
  }

  /**
   * Gets the weather.
   */
  public function getWeather(): ?string {
    return $this->weather;
  }

  /**
   * Sets the weather.
   */
  public function setWeather(string $weather): ForecastPeriod {
    $this->weather = $weather;
    return $this;
  }

  /**
   * Gets the winds.
   */
  public function getWinds(): ?string {
    return $this->winds;
  }

  /**
   * Sets the winds.
   */
  public function setWinds(string $winds): ForecastPeriod {
    $this->winds = $winds;
    return $this;
  }

}
