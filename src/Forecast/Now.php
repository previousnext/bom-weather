<?php

declare(strict_types=1);

namespace BomWeather\Forecast;

/**
 * Value object for the "now" summary on today's forecast period.
 */
final class Now {

  /**
   * Whether it is currently night.
   */
  protected ?bool $isNight = NULL;

  /**
   * The label for the current temperature, e.g. "Max".
   */
  protected ?string $nowLabel = NULL;

  /**
   * The label for the later temperature, e.g. "Overnight min".
   */
  protected ?string $laterLabel = NULL;

  /**
   * The current temperature.
   */
  protected ?float $tempNow = NULL;

  /**
   * The later temperature.
   */
  protected ?float $tempLater = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $now = new self();
    $now->isNight = $data['is_night'] ?? NULL;
    $now->nowLabel = $data['now_label'] ?? NULL;
    $now->laterLabel = $data['later_label'] ?? NULL;
    $now->tempNow = $data['temp_now'] ?? NULL;
    $now->tempLater = $data['temp_later'] ?? NULL;
    return $now;
  }

  /**
   * Gets whether it is currently night.
   */
  public function getIsNight(): ?bool {
    return $this->isNight;
  }

  /**
   * Gets the label for the current temperature.
   */
  public function getNowLabel(): ?string {
    return $this->nowLabel;
  }

  /**
   * Gets the label for the later temperature.
   */
  public function getLaterLabel(): ?string {
    return $this->laterLabel;
  }

  /**
   * Gets the current temperature.
   */
  public function getTempNow(): ?float {
    return $this->tempNow;
  }

  /**
   * Gets the later temperature.
   */
  public function getTempLater(): ?float {
    return $this->tempLater;
  }

}
