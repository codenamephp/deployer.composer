<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\test\command\factory;

use de\codenamephp\deployer\base\functions\All;
use de\codenamephp\deployer\base\functions\iGet;
use de\codenamephp\deployer\command\Command;
use de\codenamephp\deployer\command\runConfiguration\iRunConfiguration;
use de\codenamephp\deployer\command\runConfiguration\SimpleContainer;
use de\codenamephp\deployer\composer\command\factory\WithBinaryFromDeployer;
use PHPUnit\Framework\TestCase;

final class WithBinaryFromDeployerTest extends TestCase {

  private WithBinaryFromDeployer $sut;

  protected function setUp() : void {
    parent::setUp();

    $deployer = $this->createMock(iGet::class);

    $this->sut = new WithBinaryFromDeployer($deployer);
  }

  public function test__construct() : void {
    $deployer = $this->createMock(iGet::class);

    $this->sut = new WithBinaryFromDeployer($deployer);

    self::assertSame($deployer, $this->sut->deployer);
  }

  public function test__construct_withoutParameters() : void {
    $this->sut = new WithBinaryFromDeployer();

    self::assertInstanceOf(All::class, $this->sut->deployer);
  }

  public function testBuild() : void {
    $this->sut->deployer = $this->createMock(iGet::class);
    $this->sut->deployer->expects(self::once())->method('get')->with('composer:binary', 'composer')->willReturn(123);

    $runConfiguration = $this->createMock(iRunConfiguration::class);

    $command = $this->sut->build('some command', ['arg1', 'arg2'], ['some' => 'env'], true, $runConfiguration);

    self::assertInstanceOf(Command::class, $command);
    self::assertEquals('123', $command->binary);
    self::assertEquals(['--working-dir={{release_path}}', 'some command', '--no-ansi', '--no-interaction', '--no-progress', 'arg1', 'arg2'], $command->arguments);
    self::assertEquals(['some' => 'env'], $command->envVars);
    self::assertTrue($command->sudo);
    self::assertSame($runConfiguration, $command->runConfiguration);
  }

  public function testBuild_withDefaults() : void {
    $this->sut->deployer = $this->createMock(iGet::class);
    $this->sut->deployer->expects(self::once())->method('get')->with('composer:binary', 'composer')->willReturn(null);

    $command = $this->sut->build('');

    self::assertInstanceOf(Command::class, $command);
    self::assertEquals('', $command->binary);
    self::assertEquals(['--working-dir={{release_path}}', '', '--no-ansi', '--no-interaction', '--no-progress'], $command->arguments);
    self::assertEquals([], $command->envVars);
    self::assertFalse($command->sudo);
    self::assertInstanceOf(SimpleContainer::class, $command->runConfiguration);
  }
}
