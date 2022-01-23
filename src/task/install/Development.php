<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\task\install;

/**
 * Installs packages while preferring dist versions
 */
final class Development extends AbstractInstallTask {

  public function getArguments() : array {
    return ['--prefer-dist'];
  }
}