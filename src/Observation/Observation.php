<?php

declare(strict_types=1);

namespace BomWeather\Observation;

/**
 * Value object for the current observation at a location.
 */
final class Observation {

  /**
   * The air temperature.
   */
  protected ?float $temp = NULL;

  /**
   * The apparent (feels like) temperature.
   */
  protected ?float $tempFeelsLike = NULL;

  /**
   * The wind.
   */
  protected ?Wind $wind = NULL;

  /**
   * The gust.
   */
  protected ?Wind $gust = NULL;

  /**
   * The maximum gust.
   */
  protected ?Wind $maxGust = NULL;

  /**
   * The time of the maximum gust.
   */
  protected ?\DateTimeImmutable $maxGustTime = NULL;

  /**
   * The maximum temperature.
   */
  protected ?TimedValue $maxTemp = NULL;

  /**
   * The minimum temperature.
   */
  protected ?TimedValue $minTemp = NULL;

  /**
   * The rain since 9am, in millimetres.
   */
  protected ?float $rainSince9am = NULL;

  /**
   * The relative humidity, as a percentage.
   */
  protected ?int $humidity = NULL;

  /**
   * The observation station.
   */
  protected ?Station $station = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $observation = new self();
    $observation->temp = $data['temp'] ?? NULL;
    $observation->tempFeelsLike = $data['temp_feels_like'] ?? NULL;

    if (!empty($data['wind'])) {
      $observation->wind = Wind::fromArray($data['wind']);
    }
    if (!empty($data['gust'])) {
      $observation->gust = Wind::fromArray($data['gust']);
    }
    if (!empty($data['max_gust'])) {
      $observation->maxGust = Wind::fromArray($data['max_gust']);
      if (!empty($data['max_gust']['time'])) {
        $observation->maxGustTime = new \DateTimeImmutable($data['max_gust']['time']);
      }
    }
    if (!empty($data['max_temp'])) {
      $observation->maxTemp = TimedValue::fromArray($data['max_temp']);
    }
    if (!empty($data['min_temp'])) {
      $observation->minTemp = TimedValue::fromArray($data['min_temp']);
    }

    $observation->rainSince9am = $data['rain_since_9am'] ?? NULL;
    $observation->humidity = $data['humidity'] ?? NULL;

    if (!empty($data['station'])) {
      $observation->station = Station::fromArray($data['station']);
    }

    return $observation;
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
   * Gets the wind.
   */
  public function getWind(): ?Wind {
    return $this->wind;
  }

  /**
   * Gets the gust.
   */
  public function getGust(): ?Wind {
    return $this->gust;
  }

  /**
   * Gets the maximum gust.
   */
  public function getMaxGust(): ?Wind {
    return $this->maxGust;
  }

  /**
   * Gets the time of the maximum gust.
   */
  public function getMaxGustTime(): ?\DateTimeImmutable {
    return $this->maxGustTime;
  }

  /**
   * Gets the maximum temperature.
   */
  public function getMaxTemp(): ?TimedValue {
    return $this->maxTemp;
  }

  /**
   * Gets the minimum temperature.
   */
  public function getMinTemp(): ?TimedValue {
    return $this->minTemp;
  }

  /**
   * Gets the rain since 9am, in millimetres.
   */
  public function getRainSince9am(): ?float {
    return $this->rainSince9am;
  }

  /**
   * Gets the relative humidity, as a percentage.
   */
  public function getHumidity(): ?int {
    return $this->humidity;
  }

  /**
   * Gets the observation station.
   */
  public function getStation(): ?Station {
    return $this->station;
  }

}
