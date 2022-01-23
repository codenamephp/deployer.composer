<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\test\task\install;

use de\codenamephp\deployer\composer\task\install\AbstractInstallTask;
use PHPUnit\Framework\TestCase;

final class AbstractInstallTaskTest extends TestCase {

  private AbstractInstallTask $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = $this->getMockForAbstractClass(AbstractInstallTask::class);
  }

  public function testGetComposerCommand() : void {
    self::assertEquals('install', $this->sut->getComposerCommand());
  }
}
