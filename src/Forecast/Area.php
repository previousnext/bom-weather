<?php

namespace BomWeather\Forecast;

/**
 * A value object for forecast areas.
 */
class Area {

  /**
   * Location type.
   */
  const TYPE_LOCATION = 'location';

  /**
   * Metropolitan type.
   */
  const TYPE_METROPOLITAN = 'metropolitan';

  /**
   * Region type.
   */
  const TYPE_REGION = 'region';

  /**
   * The unique AAC identifier.
   *
   * @var string
   */
  protected $aac;

  /**
   * The forecast periods.
   *
   * @var \BomWeather\Forecast\ForecastPeriod[]
   */
  protected $forecastPeriods;

  /**
   * The area type.
   *
   * @var string
   */
  protected $type;

  /**
   * The description.
   *
   * @var string
   */
  protected $description;

  /**
   * The parent AAC.
   *
   * @var string
   */
  protected $parent;

  /**
   * Factory method.
   *
   * @return $this
   */
  public static function create() {
    return new static();
  }

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
  public function getParent(): ?string {
    return $this->parent;
  }

  /**
   * Sets the parent AAC.
   *
   * @param string $parent
   *   The parent AAC.
   *
   * @return $this
   */
  public function setParent(string $parent): Area {
    $this->parent = $parent;
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
