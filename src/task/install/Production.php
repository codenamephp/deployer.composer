<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\task\install;

/**
 * Runs install for production without dev and prefers stable versions. Also optimizes the autoloader
 */
final class Production extends AbstractInstallTask {

  public function getArguments() : array {
    return ['--prefer-dist', '--no-dev', '--optimize-autoloader'];
  }
}