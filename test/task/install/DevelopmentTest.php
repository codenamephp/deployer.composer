<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\test\task\install;

use de\codenamephp\deployer\composer\task\install\Development;
use PHPUnit\Framework\TestCase;

final class DevelopmentTest extends TestCase {

  private Development $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new Development();
  }

  public function testGetArguments() : void {
    self::assertEquals(['--prefer-dist'], $this->sut->getArguments());
  }

  public function testGetName() : void {
    self::assertSame(Development::NAME, $this->sut->getName());
  }

  public function testGetDescription() : void {
    self::assertSame('Runs composer install with development dependencies.', $this->sut->getDescription());
  }
}
