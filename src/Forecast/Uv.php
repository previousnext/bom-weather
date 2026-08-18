<?php

declare(strict_types=1);

namespace BomWeather\Forecast;

/**
 * Value object for a UV forecast.
 */
final class Uv {

  /**
   * The UV category, e.g. "moderate".
   */
  protected ?string $category = NULL;

  /**
   * The start time of the forecast UV category.
   */
  protected ?\DateTimeImmutable $startTime = NULL;

  /**
   * The end time of the forecast UV category.
   */
  protected ?\DateTimeImmutable $endTime = NULL;

  /**
   * The maximum UV index.
   */
  protected ?int $maxIndex = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $uv = new self();
    $uv->category = $data['category'] ?? NULL;
    if (!empty($data['start_time'])) {
      $uv->startTime = new \DateTimeImmutable($data['start_time']);
    }
    if (!empty($data['end_time'])) {
      $uv->endTime = new \DateTimeImmutable($data['end_time']);
    }
    $uv->maxIndex = $data['max_index'] ?? NULL;
    return $uv;
  }

  /**
   * Gets the UV category.
   */
  public function getCategory(): ?string {
    return $this->category;
  }

  /**
   * Gets the start time of the forecast UV category.
   */
  public function getStartTime(): ?\DateTimeImmutable {
    return $this->startTime;
  }

  /**
   * Gets the end time of the forecast UV category.
   */
  public function getEndTime(): ?\DateTimeImmutable {
    return $this->endTime;
  }

  /**
   * Gets the maximum UV index.
   */
  public function getMaxIndex(): ?int {
    return $this->maxIndex;
  }

}
