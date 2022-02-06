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

    $this->sut = new Generic('?', [], '', '', $commandFactory, $runner);
  }

  public function test__construct() : void {
    $composerCommand = 'some command';
    $arguments = ['arg1', 'arg2'];
    $taskName = 'some task name';
    $taskDescription = 'some task description';
    $commandFactory = $this->createMock(iComposerCommandFactory::class);
    $runner = $this->createMock(iRunner::class);

    $this->sut = new Generic($composerCommand, $arguments, $taskName, $taskDescription, $commandFactory, $runner);

    self::assertEquals($composerCommand, $this->sut->getComposerCommand());
    self::assertEquals($arguments, $this->sut->getArguments());
    self::assertSame($taskName, $this->sut->getName());
    self::assertSame($taskDescription, $this->sut->getDescription());
    self::assertSame($commandFactory, $this->sut->commandFactory);
    self::assertSame($runner, $this->sut->runner);
  }

  public function test__construct_withoutOptionalParameters() : void {
    $this->sut = new Generic('some command', ['arg1', 'arg2'], 'some task name');

    self::assertInstanceOf(WithBinaryFromDeployer::class, $this->sut->commandFactory);
    self::assertInstanceOf(WithDeployerFunctions::class, $this->sut->runner);
  }
}
