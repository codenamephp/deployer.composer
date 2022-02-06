<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\task;

use de\codenamephp\deployer\base\task\iTaskWithDescription;
use de\codenamephp\deployer\base\task\iTaskWithName;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\composer\command\factory\iComposerCommandFactory;
use de\codenamephp\deployer\composer\command\factory\WithBinaryFromDeployer;

/**
 * Base task for composer that provides a generic way to build and run commands.
 */
abstract class AbstractComposerTask implements iTaskWithName, iTaskWithDescription {

  public function __construct(public iComposerCommandFactory $commandFactory = new WithBinaryFromDeployer(), public iRunner $runner = new WithDeployerFunctions()) { }

  /**
   * Gets the command for composer, e.g. install or update
   *
   * @return string
   */
  abstract public function getComposerCommand() : string;

  /**
   * Gets the arguments to pass to the command. Override this and add you commands and options as needed.
   *
   * The array has to be numerical so it can be expanded
   *
   * @return array<int,string>
   */
  abstract public function getArguments() : array;

  public function __invoke() : void {
    $this->runner->run($this->commandFactory->build($this->getComposerCommand(), $this->getArguments()));
  }
}