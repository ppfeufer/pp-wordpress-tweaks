# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

<!--
GitHub MD Syntax:
https://docs.github.com/en/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax

Highlighting:
https://docs.github.com/assets/cb-41128/mw-1440/images/help/writing/alerts-rendered.webp

> [!NOTE]
> Highlights information that users should take into account, even when skimming.

> [!IMPORTANT]
> Crucial information necessary for users to succeed.

> [!WARNING]
> Critical content demanding immediate user attention due to potential risks.
-->

## Changes in Chronological Order

### [In Development] - Unreleased

<!--
Section Order:

### Added
### Fixed
### Changed
### Deprecated
### Removed
### Security
-->

### Fixed

- Fatal error: Uncaught TypeError: call_user_func_array(): Argument #1 ($callback) must be a valid callback, class Ppfeufer\\Plugin\\WordPressTweaks\\Tweaks\\Emoji does not have a method "disableTinymceEmojicons"

### Changed

- Use `__NAMESPACE__` instead of hardcoded namespace when appropriate

### [1.5.0] - 2024-12-27

### Fixed

- Ignore `/Libs` in our own autoloader

### Changed

- `pluginActionsLink` method simplified
- `Settings` moved into the `Sources` folder, to keep the root folder clean
- Use array functions instead of foreach loops
- Make the autoloader namespace-aware
- Translations updated

### Removed

- Unnecessary trailing slashes
- `Wordpress` part from the namespace

### [1.4.0] - 2024-12-09

#### Fixed

- Move `load_plugin_textdomain` to the right hook

#### Changed

- Some code optimizations

### [1.3.1] - 2024-10-16

#### Changed

- Tested compatibility to WordPress 6.7

### [1.3.0] - 2024-07-31

#### Changed

- Merge tweaks from `WP Basic Security` plugin into this plugin, so the `WP Basic Security` plugin can be retired.

### [1.2.0] - 2024-07-19

#### Changed

- Put constants under our namespace to avoid potential conflicts
- Disable core update emails only on successful updates, failed core updates will still send emails

### [1.1.0] - 2024-05-07

#### Changed

- Use anonymous functions for the `AutoUpdateMails` tweaks

### [1.0.0] - 2024-05-01

**INITIAL RELEASE**

#### Added

- Tweak to remove the auto update mails
