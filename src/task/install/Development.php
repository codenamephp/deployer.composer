<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\task\install;

/**
 * Installs packages while preferring dist versions
 */
final class Development extends AbstractInstallTask {

  public const NAME = 'composer:install:development';

  public function getArguments() : array {
    return ['--prefer-dist'];
  }

  public function getDescription() : string {
    return 'Runs composer install with development dependencies.';
  }

  public function getName() : string {
    return self::NAME;
  }
}