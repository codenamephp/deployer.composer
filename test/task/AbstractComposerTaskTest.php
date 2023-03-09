<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\test\task;

use de\codenamephp\deployer\command\iCommand;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\composer\command\factory\iComposerCommandFactory;
use de\codenamephp\deployer\composer\command\factory\WithBinaryFromDeployer;
use de\codenamephp\deployer\composer\task\AbstractComposerTask;
use PHPUnit\Framework\TestCase;

final class AbstractComposerTaskTest extends TestCase {

  private AbstractComposerTask $sut;

  protected function setUp() : void {
    parent::setUp();

    $commandFactory = $this->createMock(iComposerCommandFactory::class);
    $runner = $this->createMock(iRunner::class);

    $this->sut = $this->getMockForAbstractClass(AbstractComposerTask::class, [false, $commandFactory, $runner]);
  }

  public function test__construct() : void {
    $commandFactory = $this->createMock(iComposerCommandFactory::class);
    $runner = $this->createMock(iRunner::class);

    $this->sut = $this->getMockForAbstractClass(AbstractComposerTask::class, [true, $commandFactory, $runner]);

    self::assertTrue($this->sut->withoutScripts);
    self::assertSame($commandFactory, $this->sut->commandFactory);
    self::assertSame($runner, $this->sut->runner);
  }

  public function test__construct_withoutParameters() : void {
    $this->sut = $this->getMockForAbstractClass(AbstractComposerTask::class);

    self::assertFalse($this->sut->withoutScripts);
    self::assertInstanceOf(WithBinaryFromDeployer::class, $this->sut->commandFactory);
    self::assertInstanceOf(WithDeployerFunctions::class, $this->sut->runner);
  }

  public function test__invoke() : void {
    $this->sut->expects(self::once())->method('getComposerCommand')->willReturn('some command');

    $command = $this->createMock(iCommand::class);

    $this->sut->commandFactory = $this->createMock(iComposerCommandFactory::class);
    $this->sut->commandFactory->expects(self::once())->method('build')->with('some command', [])->willReturn($command);

    $this->sut->runner = $this->createMock(iRunner::class);
    $this->sut->runner->expects(self::once())->method('run')->with($command);

    $this->sut->__invoke();
  }

  public function testGetArguments_withoutScripts() : void {
    $this->sut = $this->getMockForAbstractClass(AbstractComposerTask::class, [true, $this->createMock(iComposerCommandFactory::class), $this->createMock(iRunner::class)]);

    self::assertSame(['--no-scripts'], $this->sut->getArguments());
  }
  public function testGetArguments() : void {
    $this->sut = $this->getMockForAbstractClass(AbstractComposerTask::class, [false, $this->createMock(iComposerCommandFactory::class), $this->createMock(iRunner::class)]);

    self::assertSame([], $this->sut->getArguments());
  }
}
