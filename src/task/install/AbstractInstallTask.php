<?php declare(strict_types=1);

namespace de\codenamephp\deployer\composer\task\install;

use de\codenamephp\deployer\composer\task\AbstractComposerTask;

/**
 * Base class for install tasks that set the install command
 */
abstract class AbstractInstallTask extends AbstractComposerTask {

  public function getComposerCommand() : string {
    return 'install';
  }
}