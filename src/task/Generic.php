<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\task;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\composer\command\factory\iComposerCommandFactory;
use de\codenamephp\deployer\composer\command\factory\WithBinaryFromDeployer;

/**
 * Generic task that can be used to run scripts on the fly
 */
final class Generic extends AbstractComposerTask {

  /**
   * @param string $composerCommand The composer command execute, e.g. install or update
   * @param array<int, string> $arguments Array of arguments with numerical indexes so they can be expanded, e.g. --prefer-dist or -v
   * @param iComposerCommandFactory $commandFactory The factory to build the command
   * @param iRunner $runner The runner to run the command
   */
  public function __construct(public readonly string  $composerCommand,
                              public readonly array   $arguments,
                              public readonly string  $taskName,
                              public readonly string  $taskDescription = '',
                              bool                    $withoutScripts = false,
                              iComposerCommandFactory $commandFactory = new WithBinaryFromDeployer(),
                              iRunner                 $runner = new WithDeployerFunctions()) {
    parent::__construct($withoutScripts, $commandFactory, $runner);
  }

  public function getComposerCommand() : string {
    return $this->composerCommand;
  }

  public function getArguments() : array {
    return [...$this->arguments, ...parent::getArguments()];
  }

  public function getDescription() : string {
    return $this->taskDescription;
  }

  public function getName() : string {
    return $this->taskName;
  }
}