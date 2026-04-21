<?php

declare(strict_types=1);

namespace BomWeather\Warning\Serializer;

use BomWeather\Trait\WeatherDataAccessorTrait;
use BomWeather\Util\BaseNormalizer;
use BomWeather\Warning\WarningInfo;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Forecast normalizer.
 */
class WarningInfoNormalizer extends BaseNormalizer {

  use WeatherDataAccessorTrait;

  protected string|array $supportedInterfaceOrClass = WarningInfo::class;

  /**
   * {@inheritdoc}
   *
   * @param mixed $data
   *   Data to restore.
   * @param string $type
   *   The expected class to instantiate.
   * @param string|null $format
   *   Format the given data was extracted from.
   * @param array<string, mixed> $context
   *   Context options for the denormalizer.
   */
  public function denormalize(mixed $data, string $type, ?string $format = NULL, array $context = []): mixed {
    if (!$this->serializer instanceof DenormalizerInterface) {
      throw new \RuntimeException('The serializer must implement the DenormalizerInterface.');
    }

    $warningInfo = (new WarningInfo());

    if (isset($data['text'])) {
      if ($this->isAssoc($data['text'])) {
        $text = $data['text'];
        $this->setTextValue($text, $warningInfo);
      }
      else {
        \array_map(function ($text) use ($warningInfo): void {
          $this->setTextValue($text, $warningInfo);
        }, $data['text'], [$warningInfo]);
      }
    }

    return $warningInfo;
  }

  /**
   * Sets a text value.
   *
   * @param array<string, mixed> $text
   *   The text array.
   * @param \BomWeather\Warning\WarningInfo $warningInfo
   *   The warning info.
   */
  public function setTextValue(array $text, WarningInfo $warningInfo): void {
    // Extract text content, handling nested <p> tags.
    $value = $this->extractTextContent($text);

    // Handle warning_advice specially as it can be an array.
    if (($text['@type'] ?? NULL) === 'warning_advice') {
      if (\is_array($text['p'] ?? NULL)) {
        foreach ($text['p'] as $advice) {
          if (\is_string($advice)) {
            $warningInfo->setWarningAdvice($advice);
          }
        }
      }
      elseif ($value !== NULL) {
        $warningInfo->setWarningAdvice($value);
      }
      return;
    }

    if ($value === NULL) {
      return;
    }

    match ($text['@type'] ?? NULL) {
      'warning_title' => $warningInfo->setWarningTitle($value),
      'preamble' => $warningInfo->setPreamble($value),
      'warning_next_issue' => $warningInfo->setWarningNextIssue($value),
      'postamble' => $warningInfo->setPostamble($value),
      'warning_area_summary' => $warningInfo->setAreaSummary($value),
      'warning_phenomena_summary' => $warningInfo->setPhenomenaSummary($value),
      'warning_headline' => $warningInfo->setHeadline($value),
      'synoptic_situation' => $warningInfo->setSynopticSituation($value),
      'warning_advice_contact' => $warningInfo->setWarningAdvice($value),
      default => NULL,
    };
  }

}
