<?php

declare(strict_types=1);

namespace BomWeather\Forecast;

/**
 * A value object for forecast areas.
 */
final class Area {

  /**
   * Location type.
   */
  const TYPE_LOCATION = 'location';

  /**
   * Metropolitan type.
   */
  const TYPE_METROPOLITAN = 'metropolitan';

  /**
   * District type.
   */
  const TYPE_DISTRICT = 'public-district';

  /**
   * Region type.
   */
  const TYPE_REGION = 'region';

  /**
   * Coast type.
   */
  const TYPE_COAST = 'coast';


  /**
   * The unique AAC identifier.
   */
  protected string $aac;

  /**
   * The forecast periods.
   *
   * @var \BomWeather\Forecast\ForecastPeriod[]
   */
  protected array $forecastPeriods;

  /**
   * The area type.
   */
  protected string $type;

  /**
   * The description.
   */
  protected string $description;

  /**
   * The parent AAC.
   */
  protected string $parentAac;

  /**
   * Gets the type.
   *
   * @return string
   *   The type.
   */
  public function getType(): string {
    return $this->type;
  }

  /**
   * Sets the type.
   *
   * @param string $type
   *   The type.
   *
   * @return $this
   */
  public function setType(string $type): Area {
    $this->type = $type;
    return $this;
  }

  /**
   * Gets the unique AAC identifier.
   *
   * @return string
   *   The unique AAC identifier.
   */
  public function getAac(): string {
    return $this->aac;
  }

  /**
   * Sets the unique AAC identifier.
   *
   * @param string $aac
   *   The unique AAC identifier.
   *
   * @return $this
   */
  public function setAac(string $aac): Area {
    $this->aac = $aac;
    return $this;
  }

  /**
   * Gets the description.
   *
   * @return string
   *   The description.
   */
  public function getDescription(): string {
    return $this->description;
  }

  /**
   * Sets the description.
   *
   * @param string $description
   *   The description.
   *
   * @return $this
   */
  public function setDescription(string $description): Area {
    $this->description = $description;
    return $this;
  }

  /**
   * Gets the parent AAC.
   *
   * @return string
   *   The parent.
   */
  public function getParentAac(): ?string {
    return $this->parentAac;
  }

  /**
   * Sets the parent AAC.
   *
   * @param string $parentAac
   *   The parent AAC.
   *
   * @return $this
   */
  public function setParentAac(string $parentAac): Area {
    $this->parentAac = $parentAac;
    return $this;
  }

  /**
   * Gets the forecast periods.
   *
   * @return \BomWeather\Forecast\ForecastPeriod[]
   *   The forecast periods.
   */
  public function getForecastPeriods(): array {
    return $this->forecastPeriods;
  }

  /**
   * Sets the forecast periods.
   *
   * @param \BomWeather\Forecast\ForecastPeriod[] $forecastPeriods
   *   The forecast periods.
   *
   * @return $this
   */
  public function setForecastPeriods(array $forecastPeriods): Area {
    $this->forecastPeriods = $forecastPeriods;
    return $this;
  }

  /**
   * Adds a forecast period.
   *
   * @param \BomWeather\Forecast\ForecastPeriod $forecastPeriod
   *   The forecast period.
   *
   * @return $this
   */
  public function addForecastPeriod(ForecastPeriod $forecastPeriod): Area {
    $this->forecastPeriods[] = $forecastPeriod;
    return $this;
  }

}
