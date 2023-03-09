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

    $this->sut = new Generic('?', [], '', '', false, $commandFactory, $runner);
  }

  public function test__construct() : void {
    $composerCommand = 'some command';
    $arguments = ['arg1', 'arg2'];
    $taskName = 'some task name';
    $taskDescription = 'some task description';
    $commandFactory = $this->createMock(iComposerCommandFactory::class);
    $runner = $this->createMock(iRunner::class);

    $this->sut = new Generic($composerCommand, $arguments, $taskName, $taskDescription, true, $commandFactory, $runner);

    self::assertEquals($composerCommand, $this->sut->getComposerCommand());
    self::assertEquals($arguments, $this->sut->arguments);
    self::assertSame($taskName, $this->sut->getName());
    self::assertTrue($this->sut->withoutScripts);
    self::assertSame($taskDescription, $this->sut->getDescription());
    self::assertSame($commandFactory, $this->sut->commandFactory);
    self::assertSame($runner, $this->sut->runner);
  }

  public function test__construct_withoutOptionalParameters() : void {
    $this->sut = new Generic('some command', ['arg1', 'arg2'], 'some task name');

    self::assertInstanceOf(WithBinaryFromDeployer::class, $this->sut->commandFactory);
    self::assertInstanceOf(WithDeployerFunctions::class, $this->sut->runner);
    self::assertFalse($this->sut->withoutScripts);
  }

  public function testGetArguments_canMergeWithParentArguments() : void {
    $this->sut = new Generic('some command', ['arg1', 'arg2'], 'some task name', withoutScripts: true);

    self::assertSame(['arg1', 'arg2', '--no-scripts'], $this->sut->getArguments());
  }
}
