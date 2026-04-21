<?php

declare(strict_types=1);

namespace BomWeather\Warning;

/**
 * Hazard urgency levels.
 */
enum HazardUrgency: string {

  case Immediate = 'IMM';
  case Expected = 'EXP';
  case Future = 'FUT';
  case Past = 'PST';
  case Unknown = 'UNK';

}
