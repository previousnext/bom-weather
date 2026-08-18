<?php

declare(strict_types=1);

namespace BomWeather\Forecast;

/**
 * Value object for the rain forecast on a daily forecast period.
 */
final class DailyRain {

  /**
   * The minimum rain amount, in millimetres.
   */
  protected ?float $amountMin = NULL;

  /**
   * The maximum rain amount, in millimetres.
   */
  protected ?float $amountMax = NULL;

  /**
   * The lower range of the rain amount, in millimetres.
   */
  protected ?float $amountLowerRange = NULL;

  /**
   * The upper range of the rain amount, in millimetres.
   */
  protected ?float $amountUpperRange = NULL;

  /**
   * The units the rain amount is measured in.
   */
  protected ?string $amountUnits = NULL;

  /**
   * The chance of rain, as a percentage.
   */
  protected ?int $chance = NULL;

  /**
   * The chance of no rain category, e.g. "medium".
   */
  protected ?string $chanceOfNoRainCategory = NULL;

  /**
   * The rain amount with a 25% chance of being exceeded.
   */
  protected ?float $precipitationAmount25PercentChance = NULL;

  /**
   * The rain amount with a 50% chance of being exceeded.
   */
  protected ?float $precipitationAmount50PercentChance = NULL;

  /**
   * The rain amount with a 75% chance of being exceeded.
   */
  protected ?float $precipitationAmount75PercentChance = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $rain = new self();
    $amount = $data['amount'] ?? [];
    $rain->amountMin = $amount['min'] ?? NULL;
    $rain->amountMax = $amount['max'] ?? NULL;
    $rain->amountLowerRange = $amount['lower_range'] ?? NULL;
    $rain->amountUpperRange = $amount['upper_range'] ?? NULL;
    $rain->amountUnits = $amount['units'] ?? NULL;
    $rain->chance = $data['chance'] ?? NULL;
    $rain->chanceOfNoRainCategory = $data['chance_of_no_rain_category'] ?? NULL;
    $rain->precipitationAmount25PercentChance = $data['precipitation_amount_25_percent_chance'] ?? NULL;
    $rain->precipitationAmount50PercentChance = $data['precipitation_amount_50_percent_chance'] ?? NULL;
    $rain->precipitationAmount75PercentChance = $data['precipitation_amount_75_percent_chance'] ?? NULL;
    return $rain;
  }

  /**
   * Gets the minimum rain amount, in millimetres.
   */
  public function getAmountMin(): ?float {
    return $this->amountMin;
  }

  /**
   * Gets the maximum rain amount, in millimetres.
   */
  public function getAmountMax(): ?float {
    return $this->amountMax;
  }

  /**
   * Gets the lower range of the rain amount, in millimetres.
   */
  public function getAmountLowerRange(): ?float {
    return $this->amountLowerRange;
  }

  /**
   * Gets the upper range of the rain amount, in millimetres.
   */
  public function getAmountUpperRange(): ?float {
    return $this->amountUpperRange;
  }

  /**
   * Gets the units the rain amount is measured in.
   */
  public function getAmountUnits(): ?string {
    return $this->amountUnits;
  }

  /**
   * Gets the chance of rain, as a percentage.
   */
  public function getChance(): ?int {
    return $this->chance;
  }

  /**
   * Gets the chance of no rain category.
   */
  public function getChanceOfNoRainCategory(): ?string {
    return $this->chanceOfNoRainCategory;
  }

  /**
   * Gets the rain amount with a 25% chance of being exceeded.
   */
  public function getPrecipitationAmount25PercentChance(): ?float {
    return $this->precipitationAmount25PercentChance;
  }

  /**
   * Gets the rain amount with a 50% chance of being exceeded.
   */
  public function getPrecipitationAmount50PercentChance(): ?float {
    return $this->precipitationAmount50PercentChance;
  }

  /**
   * Gets the rain amount with a 75% chance of being exceeded.
   */
  public function getPrecipitationAmount75PercentChance(): ?float {
    return $this->precipitationAmount75PercentChance;
  }

}
