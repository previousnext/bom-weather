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
   *
   * @var string[]
   */
  protected array $warningAdvice = [];

  /**
   * The warning next issue help text.
   */
  protected ?string $warningNextIssue = NULL;

  /**
   * The postamble text.
   */
  protected ?string $postamble = NULL;

  /**
   * The warning area summary.
   */
  protected ?string $areaSummary = NULL;

  /**
   * The warning phenomena summary.
   */
  protected ?string $phenomenaSummary = NULL;

  /**
   * The warning headline.
   */
  protected ?string $headline = NULL;

  /**
   * The synoptic situation.
   */
  protected ?string $synopticSituation = NULL;

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
   *
   * @return string[]
   *   The warning advices.
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

  /**
   * Gets the postamble text.
   */
  public function getPostamble(): ?string {
    return $this->postamble;
  }

  /**
   * Sets the postamble text.
   */
  public function setPostamble(?string $postamble): WarningInfo {
    $this->postamble = $postamble;
    return $this;
  }

  /**
   * Gets the area summary.
   */
  public function getAreaSummary(): ?string {
    return $this->areaSummary;
  }

  /**
   * Sets the area summary.
   */
  public function setAreaSummary(?string $areaSummary): WarningInfo {
    $this->areaSummary = $areaSummary;
    return $this;
  }

  /**
   * Gets the phenomena summary.
   */
  public function getPhenomenaSummary(): ?string {
    return $this->phenomenaSummary;
  }

  /**
   * Sets the phenomena summary.
   */
  public function setPhenomenaSummary(?string $phenomenaSummary): WarningInfo {
    $this->phenomenaSummary = $phenomenaSummary;
    return $this;
  }

  /**
   * Gets the headline.
   */
  public function getHeadline(): ?string {
    return $this->headline;
  }

  /**
   * Sets the headline.
   */
  public function setHeadline(?string $headline): WarningInfo {
    $this->headline = $headline;
    return $this;
  }

  /**
   * Gets the synoptic situation.
   */
  public function getSynopticSituation(): ?string {
    return $this->synopticSituation;
  }

  /**
   * Sets the synoptic situation.
   */
  public function setSynopticSituation(?string $synopticSituation): WarningInfo {
    $this->synopticSituation = $synopticSituation;
    return $this;
  }

}
