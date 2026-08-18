<?php

declare(strict_types=1);

namespace BomWeather\Forecast;

/**
 * Value object for a single hour's forecast.
 */
final class HourlyForecast {

  /**
   * The time.
   */
  protected ?\DateTimeImmutable $time = NULL;

  /**
   * Whether it is night at this time.
   */
  protected ?bool $isNight = NULL;

  /**
   * The start time of the next hourly forecast period.
   */
  protected ?\DateTimeImmutable $nextForecastPeriod = NULL;

  /**
   * The start time of the next 3-hourly forecast period.
   */
  protected ?\DateTimeImmutable $nextThreeHourlyForecastPeriod = NULL;

  /**
   * The air temperature.
   */
  protected ?float $temp = NULL;

  /**
   * The apparent (feels like) temperature.
   */
  protected ?float $tempFeelsLike = NULL;

  /**
   * The dew point.
   */
  protected ?float $dewPoint = NULL;

  /**
   * The relative humidity, as a percentage.
   */
  protected ?int $relativeHumidity = NULL;

  /**
   * The icon descriptor.
   */
  protected ?string $iconDescriptor = NULL;

  /**
   * The UV index.
   */
  protected ?int $uv = NULL;

  /**
   * The wind forecast.
   */
  protected ?Wind $wind = NULL;

  /**
   * The rain forecast.
   */
  protected ?HourlyRain $rain = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $forecast = new self();
    if (!empty($data['time'])) {
      $forecast->time = new \DateTimeImmutable($data['time']);
    }
    $forecast->isNight = $data['is_night'] ?? NULL;
    if (!empty($data['next_forecast_period'])) {
      $forecast->nextForecastPeriod = new \DateTimeImmutable($data['next_forecast_period']);
    }
    if (!empty($data['next_three_hourly_forecast_period'])) {
      $forecast->nextThreeHourlyForecastPeriod = new \DateTimeImmutable($data['next_three_hourly_forecast_period']);
    }
    $forecast->temp = $data['temp'] ?? NULL;
    $forecast->tempFeelsLike = $data['temp_feels_like'] ?? NULL;
    $forecast->dewPoint = $data['dew_point'] ?? NULL;
    $forecast->relativeHumidity = $data['relative_humidity'] ?? NULL;
    $forecast->iconDescriptor = $data['icon_descriptor'] ?? NULL;
    $forecast->uv = $data['uv'] ?? NULL;

    if (!empty($data['wind'])) {
      $forecast->wind = Wind::fromArray($data['wind']);
    }
    if (!empty($data['rain'])) {
      $forecast->rain = HourlyRain::fromArray($data['rain']);
    }

    return $forecast;
  }

  /**
   * Gets the time.
   */
  public function getTime(): ?\DateTimeImmutable {
    return $this->time;
  }

  /**
   * Gets whether it is night at this time.
   */
  public function getIsNight(): ?bool {
    return $this->isNight;
  }

  /**
   * Gets the start time of the next hourly forecast period.
   */
  public function getNextForecastPeriod(): ?\DateTimeImmutable {
    return $this->nextForecastPeriod;
  }

  /**
   * Gets the start time of the next 3-hourly forecast period.
   */
  public function getNextThreeHourlyForecastPeriod(): ?\DateTimeImmutable {
    return $this->nextThreeHourlyForecastPeriod;
  }

  /**
   * Gets the air temperature.
   */
  public function getTemp(): ?float {
    return $this->temp;
  }

  /**
   * Gets the apparent (feels like) temperature.
   */
  public function getTempFeelsLike(): ?float {
    return $this->tempFeelsLike;
  }

  /**
   * Gets the dew point.
   */
  public function getDewPoint(): ?float {
    return $this->dewPoint;
  }

  /**
   * Gets the relative humidity, as a percentage.
   */
  public function getRelativeHumidity(): ?int {
    return $this->relativeHumidity;
  }

  /**
   * Gets the icon descriptor.
   */
  public function getIconDescriptor(): ?string {
    return $this->iconDescriptor;
  }

  /**
   * Gets the UV index.
   */
  public function getUv(): ?int {
    return $this->uv;
  }

  /**
   * Gets the wind forecast.
   */
  public function getWind(): ?Wind {
    return $this->wind;
  }

  /**
   * Gets the rain forecast.
   */
  public function getRain(): ?HourlyRain {
    return $this->rain;
  }

}
