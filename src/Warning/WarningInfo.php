<?php

declare(strict_types=1);

namespace BomWeather\Warning;

/**
 * A value object for weather warning information.
 */
final class WarningInfo {

  /**
   * The warning title.
   */
  protected ?string $warningTitle = NULL;

  /**
   * The warning preamble text.
   */
  protected ?string $preamble = NULL;

  /**
   * The warning advices.
   */
  protected array $warningAdvice = [];

  /**
   * The warning next issue help text.
   */
  protected ?string $warningNextIssue = NULL;

  /**
   * Gets the warning title.
   */
  public function getWarningTitle(): ?string {
    return $this->warningTitle;
  }

  /**
   * Sets the warning title.
   */
  public function setWarningTitle(?string $warningTitle): WarningInfo {
    $this->warningTitle = $warningTitle;
    return $this;
  }

  /**
   * Gets the preamble text.
   */
  public function getPreamble(): ?string {
    return $this->preamble;
  }

  /**
   * Sets the preamble text.
   */
  public function setPreamble(?string $preamble): WarningInfo {
    $this->preamble = $preamble;
    return $this;
  }

  /**
   * Gets an array of warning advices.
   */
  public function getWarningAdvices(): array {
    return $this->warningAdvice;
  }

  /**
   * Sets warning advice to advices array.
   */
  public function setWarningAdvice(string $warningAdvice): WarningInfo {
    $this->warningAdvice[] = $warningAdvice;
    return $this;
  }

  /**
   * Get the text for next warning issue date.
   */
  public function getWarningNextIssue(): ?string {
    return $this->warningNextIssue;
  }

  /**
   * Set the text for next warning issue date.
   */
  public function setWarningNextIssue(?string $warningNextIssue): WarningInfo {
    $this->warningNextIssue = $warningNextIssue;
    return $this;
  }

}
