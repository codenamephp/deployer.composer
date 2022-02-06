# deployer.composer

![Packagist Version](https://img.shields.io/packagist/v/codenamephp/deployer.composer)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/codenamephp/deployer.composer)
![Lines of code](https://img.shields.io/tokei/lines/github/codenamephp/deployer.composer)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/codenamephp/deployer.composer)
![CI](https://github.com/codenamephp/deployer.composer/workflows/CI/badge.svg)
![Packagist Downloads](https://img.shields.io/packagist/dt/codenamephp/deployer.composer)
![GitHub](https://img.shields.io/github/license/codenamephp/deployer.composer)

## What is it?

This package adds deployer tasks and a command factory for running composer on the command line.

## Installation

Easiest way is via composer. Just run `composer require codenamephp/deployer.composer` in your cli which should install the latest version for you.

## Usage

Just use the built in tasks in your deployer file or create your own by using the command factory and a command runner or just
extend `\de\codenamephp\deployer\composer\task\AbstractComposerTask`