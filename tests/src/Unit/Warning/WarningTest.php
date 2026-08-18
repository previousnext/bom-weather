<?php

declare(strict_types=1);

namespace BomWeather\Tests\Unit\Warning;

use BomWeather\Tests\FixtureTrait;
use BomWeather\Warning\Warning;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Warning value object.
 */
#[CoversClass(Warning::class)]
class WarningTest extends TestCase {

  use FixtureTrait;

  /**
   * Tests hydration of a warning list item.
   */
  public function testFromArrayListItem(): void {
    $json = $this->readFixture('warnings.json');
    $data = \json_decode($json, TRUE);

    $warning = Warning::fromArray($data['data'][0]);

    $this->assertEquals('VIC_MW005_IDV20600', $warning->getId());
    $this->assertEquals('VIC_MW005', $warning->getAreaId());
    $this->assertEquals('marine_wind_warning', $warning->getType());
    $this->assertEquals('Marine Wind Warning for Victoria', $warning->getTitle());
    $this->assertEquals('Marine Wind Warning', $warning->getShortTitle());
    $this->assertEquals('VIC', $warning->getState());
    $this->assertEquals('minor', $warning->getWarningGroupType());
    $this->assertEquals('renewal', $warning->getPhase());
    $this->assertEquals('2026-08-18T00:00:00+00:00', $warning->getIssueTime()->format(\DATE_RFC3339));
    $this->assertNull($warning->getMessage());
  }

  /**
   * Tests hydration of a single warning's detail.
   */
  public function testFromArrayDetail(): void {
    $json = $this->readFixture('warning-detail.json');
    $data = \json_decode($json, TRUE);

    $warning = Warning::fromArray($data['data']);

    $this->assertEquals('VIC_MW005_IDV20600', $warning->getId());
    $this->assertStringContainsString('Strong Wind Warning', $warning->getMessage());
    $this->assertNull($warning->getAreaId());
  }

}
