# Migration

This document contains all steps that are needed to migrate between versions.

## 2.x - 3.x
`\de\codenamephp\deployer\composer\task\AbstractComposerTask::__construct` now has a new optional withoutScripts parameter. If you have extended the class 
you need to add the parameter to your constructor and pass it to the parent constructor.

Also the `\de\codenamephp\deployer\composer\task\AbstractComposerTask::getArguments` is now implemented. Make sure to update your classes to merge with the 
call.


## 1.x - 2.x

The `\de\codenamephp\deployer\base\task\iTaskWithName` and `\de\codenamephp\deployer\base\task\iTaskWithDescription` were added to
the `\de\codenamephp\deployer\composer\task\AbstractComposerTask` so you need to implement the `getName()` and `getDescription()` methods if you have extended
the class.