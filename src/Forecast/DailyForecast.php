<?php

declare(strict_types=1);

namespace BomWeather\Forecast;

/**
 * Value object for a single day's forecast.
 */
final class DailyForecast {

  /**
   * The date.
   */
  protected ?\DateTimeImmutable $date = NULL;

  /**
   * The maximum temperature.
   */
  protected ?float $tempMax = NULL;

  /**
   * The minimum temperature.
   */
  protected ?float $tempMin = NULL;

  /**
   * The extended forecast text.
   */
  protected ?string $extendedText = NULL;

  /**
   * The short forecast text.
   */
  protected ?string $shortText = NULL;

  /**
   * The icon descriptor.
   */
  protected ?string $iconDescriptor = NULL;

  /**
   * The surf danger.
   */
  protected ?string $surfDanger = NULL;

  /**
   * The fire danger.
   */
  protected ?string $fireDanger = NULL;

  /**
   * The fire danger category.
   */
  protected ?FireDangerCategory $fireDangerCategory = NULL;

  /**
   * The rain forecast.
   */
  protected ?DailyRain $rain = NULL;

  /**
   * The UV forecast.
   */
  protected ?Uv $uv = NULL;

  /**
   * The astronomical data.
   */
  protected ?Astronomical $astronomical = NULL;

  /**
   * The "now" summary. Only present on today's forecast period.
   */
  protected ?Now $now = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $forecast = new self();
    if (!empty($data['date'])) {
      $forecast->date = new \DateTimeImmutable($data['date']);
    }
    $forecast->tempMax = $data['temp_max'] ?? NULL;
    $forecast->tempMin = $data['temp_min'] ?? NULL;
    $forecast->extendedText = $data['extended_text'] ?? NULL;
    $forecast->shortText = $data['short_text'] ?? NULL;
    $forecast->iconDescriptor = $data['icon_descriptor'] ?? NULL;
    $forecast->surfDanger = $data['surf_danger'] ?? NULL;
    $forecast->fireDanger = $data['fire_danger'] ?? NULL;

    if (!empty($data['fire_danger_category'])) {
      $forecast->fireDangerCategory = FireDangerCategory::fromArray($data['fire_danger_category']);
    }
    if (!empty($data['rain'])) {
      $forecast->rain = DailyRain::fromArray($data['rain']);
    }
    if (!empty($data['uv'])) {
      $forecast->uv = Uv::fromArray($data['uv']);
    }
    if (!empty($data['astronomical'])) {
      $forecast->astronomical = Astronomical::fromArray($data['astronomical']);
    }
    if (!empty($data['now'])) {
      $forecast->now = Now::fromArray($data['now']);
    }

    return $forecast;
  }

  /**
   * Gets the date.
   */
  public function getDate(): ?\DateTimeImmutable {
    return $this->date;
  }

  /**
   * Gets the maximum temperature.
   */
  public function getTempMax(): ?float {
    return $this->tempMax;
  }

  /**
   * Gets the minimum temperature.
   */
  public function getTempMin(): ?float {
    return $this->tempMin;
  }

  /**
   * Gets the extended forecast text.
   */
  public function getExtendedText(): ?string {
    return $this->extendedText;
  }

  /**
   * Gets the short forecast text.
   */
  public function getShortText(): ?string {
    return $this->shortText;
  }

  /**
   * Gets the icon descriptor.
   */
  public function getIconDescriptor(): ?string {
    return $this->iconDescriptor;
  }

  /**
   * Gets the surf danger.
   */
  public function getSurfDanger(): ?string {
    return $this->surfDanger;
  }

  /**
   * Gets the fire danger.
   */
  public function getFireDanger(): ?string {
    return $this->fireDanger;
  }

  /**
   * Gets the fire danger category.
   */
  public function getFireDangerCategory(): ?FireDangerCategory {
    return $this->fireDangerCategory;
  }

  /**
   * Gets the rain forecast.
   */
  public function getRain(): ?DailyRain {
    return $this->rain;
  }

  /**
   * Gets the UV forecast.
   */
  public function getUv(): ?Uv {
    return $this->uv;
  }

  /**
   * Gets the astronomical data.
   */
  public function getAstronomical(): ?Astronomical {
    return $this->astronomical;
  }

  /**
   * Gets the "now" summary.
   */
  public function getNow(): ?Now {
    return $this->now;
  }

}
