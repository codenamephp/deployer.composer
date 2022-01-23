<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\test\task;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\composer\command\factory\iComposerCommandFactory;
use de\codenamephp\deployer\composer\command\factory\WithBinaryFromDeployer;
use de\codenamephp\deployer\composer\task\Generic;
use PHPUnit\Framework\TestCase;

final class GenericTest extends TestCase {

  private Generic $sut;

  protected function setUp() : void {
    parent::setUp();

    $commandFactory = $this->createMock(iComposerCommandFactory::class);
    $runner = $this->createMock(iRunner::class);

    $this->sut = new Generic('?', [], $commandFactory, $runner);
  }

  public function test__construct() : void {
    $composerCommand = 'some command';
    $arguments = ['arg1', 'arg2'];
    $commandFactory = $this->createMock(iComposerCommandFactory::class);
    $runner = $this->createMock(iRunner::class);

    $this->sut = new Generic($composerCommand, $arguments, $commandFactory, $runner);

    self::assertEquals($composerCommand, $this->sut->getComposerCommand());
    self::assertEquals($arguments, $this->sut->getArguments());
    self::assertSame($commandFactory, $this->sut->commandFactory);
    self::assertSame($runner, $this->sut->runner);
  }

  public function test__construct_withoutOptionalParameters() : void {
    $this->sut = new Generic('some command', ['arg1', 'arg2']);

    self::assertInstanceOf(WithBinaryFromDeployer::class, $this->sut->commandFactory);
    self::assertInstanceOf(WithDeployerFunctions::class, $this->sut->runner);
  }
}
