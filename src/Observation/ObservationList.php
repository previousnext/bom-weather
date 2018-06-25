<?php

namespace BomWeather\Observation;

/**
 * A value object for a list of observations.
 */
class ObservationList {

  /**
   * The list of observations.
   *
   * @var \BomWeather\Observation\Observation[]
   */
  protected $observations;

  /**
   * The refresh message.
   *
   * @var string
   */
  protected $refreshMessage;

  /**
   * Gets the Observations.
   *
   * @return \BomWeather\Observation\Observation[]
   *   The Observations.
   */
  public function getObservations(): array {
    return $this->observations;
  }

  /**
   * Sets the Observations.
   *
   * @param \BomWeather\Observation\Observation[] $observations
   *   The Observations.
   *
   * @return $this
   */
  public function setObservations(array $observations): ObservationList {
    $this->observations = $observations;
    return $this;
  }

  /**
   * Adds an observation.
   *
   * @param \BomWeather\Observation\Observation $observation
   *   The observation.
   *
   * @return $this
   */
  public function addObservation(Observation $observation): ObservationList {
    $this->observations[] = $observation;
    return $this;
  }

  /**
   * Gets the latest observation.
   *
   * @return \BomWeather\Observation\Observation|null
   *   The observation, or NULL if none.
   */
  public function getLatest(): ?Observation {
    if (!empty($this->observations)) {
      return $this->observations[0];
    }
    return NULL;
  }

  /**
   * Gets the Refresh Message.
   *
   * @return string
   *   The RefreshMessage.
   */
  public function getRefreshMessage(): string {
    return $this->refreshMessage;
  }

  /**
   * Sets the Refresh Message.
   *
   * @param string $refreshMessage
   *   The RefreshMessage.
   *
   * @return $this
   */
  public function setRefreshMessage(string $refreshMessage): ObservationList {
    $this->refreshMessage = $refreshMessage;
    return $this;
  }

}
