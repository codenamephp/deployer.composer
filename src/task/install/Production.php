<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\task\install;

/**
 * Runs install for production without dev and prefers stable versions. Also optimizes the autoloader
 */
final class Production extends AbstractInstallTask {

  public const NAME = 'composer:install';

  public function getArguments() : array {
    return ['--prefer-dist', '--no-dev', '--optimize-autoloader', ...parent::getArguments()];
  }

  public function getDescription() : string {
    return 'Runs composer with --no-dev flag so dev dependencies are not installed. Also optimizes autoloader.';
  }

  public function getName() : string {
    return self::NAME;
  }
}