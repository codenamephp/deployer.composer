<?php declare(strict_types=1);
/*
 *   Copyright 2022 Bastian Schwarz <bastian@codename-php.de>.
 *
 *   Licensed under the Apache License, Version 2.0 (the "License");
 *   you may not use this file except in compliance with the License.
 *   You may obtain a copy of the License at
 *
 *         http://www.apache.org/licenses/LICENSE-2.0
 *
 *   Unless required by applicable law or agreed to in writing, software
 *   distributed under the License is distributed on an "AS IS" BASIS,
 *   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *   See the License for the specific language governing permissions and
 *   limitations under the License.
 */

namespace de\codenamephp\deployer\composer\command\factory;

use de\codenamephp\deployer\base\functions\All;
use de\codenamephp\deployer\base\functions\iGet;
use de\codenamephp\deployer\command\Command;
use de\codenamephp\deployer\command\iCommand;
use de\codenamephp\deployer\command\runConfiguration\iRunConfiguration;
use de\codenamephp\deployer\command\runConfiguration\SimpleContainer;

/**
 * Factory that gets the composer binary from deployer with a fallback to composer and adds the --working-dir with the release_path from deployer
 */
final class WithBinaryFromDeployer implements iComposerCommandFactory {

  public function __construct(public iGet $deployer = new All()) {}

  /**
   * Gets the composer binary from deployer and also sets the working-dir so we can call composer from wherever and sets no-ansi no-interaction and no-progress
   * for console
   *
   * @inheritdoc
   */
  public function build(string $command, array $arguments = [], array $envVars = [], bool $sudo = false, iRunConfiguration $runConfiguration = null) : iCommand {
    return new Command((string) $this->deployer->get('composer:binary', 'composer'), [
      '--working-dir={{release_path}}',
      $command,
      '--no-ansi',
      '--no-interaction',
      '--no-progress',
      ...$arguments], $envVars, $sudo, $runConfiguration ?? new SimpleContainer());
  }
}