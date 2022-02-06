# Migration

This document contains all steps that are needed to migrate between versions.

## 1.x - 2.x

The `\de\codenamephp\deployer\base\task\iTaskWithName` and `\de\codenamephp\deployer\base\task\iTaskWithDescription` were added to
the `\de\codenamephp\deployer\composer\task\AbstractComposerTask` so you need to implement the `getName()` and `getDescription()` methods if you have extended
the class.