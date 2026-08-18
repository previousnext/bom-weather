<?php

declare(strict_types=1);

namespace BomWeather\Forecast;

/**
 * Value object for the rain forecast on an hourly forecast period.
 */
final class HourlyRain {

  /**
   * The minimum rain amount, in millimetres.
   */
  protected ?float $amountMin = NULL;

  /**
   * The maximum rain amount, in millimetres.
   */
  protected ?float $amountMax = NULL;

  /**
   * The units the rain amount is measured in.
   */
  protected ?string $amountUnits = NULL;

  /**
   * The chance of rain, as a percentage.
   */
  protected ?int $chance = NULL;

  /**
   * The rain amount with a 10% chance of being exceeded.
   */
  protected ?float $precipitationAmount10PercentChance = NULL;

  /**
   * The rain amount with a 25% chance of being exceeded.
   */
  protected ?float $precipitationAmount25PercentChance = NULL;

  /**
   * The rain amount with a 50% chance of being exceeded.
   */
  protected ?float $precipitationAmount50PercentChance = NULL;

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
    $rain->amountUnits = $amount['units'] ?? NULL;
    $rain->chance = $data['chance'] ?? NULL;
    $rain->precipitationAmount10PercentChance = $data['precipitation_amount_10_percent_chance'] ?? NULL;
    $rain->precipitationAmount25PercentChance = $data['precipitation_amount_25_percent_chance'] ?? NULL;
    $rain->precipitationAmount50PercentChance = $data['precipitation_amount_50_percent_chance'] ?? NULL;
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
   * Gets the rain amount with a 10% chance of being exceeded.
   */
  public function getPrecipitationAmount10PercentChance(): ?float {
    return $this->precipitationAmount10PercentChance;
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

}
