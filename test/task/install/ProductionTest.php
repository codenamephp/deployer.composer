<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\test\task\install;

use de\codenamephp\deployer\composer\task\install\Production;
use PHPUnit\Framework\TestCase;

final class ProductionTest extends TestCase {

  private Production $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new Production();
  }

  public function testGetArguments() : void {
    self::assertEquals(['--prefer-dist', '--no-dev', '--optimize-autoloader'], $this->sut->getArguments());
  }
}
