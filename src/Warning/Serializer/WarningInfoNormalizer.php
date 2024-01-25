<?php

declare(strict_types=1);

namespace BomWeather\Warning\Serializer;

use BomWeather\Util\BaseNormalizer;
use BomWeather\Warning\WarningInfo;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Forecast normalizer.
 */
class WarningInfoNormalizer extends BaseNormalizer {

  /**
   * {@inheritdoc}
   */
  protected string|array $supportedInterfaceOrClass = WarningInfo::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $type, $format = NULL, array $context = []) {
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
   * @param array $text
   *   The text array.
   * @param \BomWeather\Warning\WarningInfo $warningInfo
   *   The warning info.
   */
  public function setTextValue(array $text, WarningInfo $warningInfo): void {
    match ($text['@type']) {
      'warning_title' => $warningInfo->setWarningTitle($text['#']),
      'preamble' => $warningInfo->setPreamble($text['#']),
      'warning_advice' => \array_map(function ($advice) use ($warningInfo): void {
        $warningInfo->setWarningAdvice($advice);
      }, $text['p']),
      'warning_next_issue' => $warningInfo->setWarningNextIssue($text['#']),
      default => '',
    };
  }

}
