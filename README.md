# Shunt

## Contents of This File

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)
- [Implementation](#implementation)


## Introduction

Current maintainer: [whitehouse](https://www.drupal.org/u/whitehouse)

> In electronics, a shunt is a device which allows electric current to pass
> around another point in the circuit by creating a low resistance path.
>
> -- <cite>[Wikipedia](http://en.wikipedia.org/wiki/Shunt_(electrical))</cite>

Shunt module provides a facility for developers to create virtual "shunts" that
site administrators can enable (or "trip") in emergency situations, instructing
Drupal to fail gracefully where functionality depends on them.

For example, you might create a shunt that disables certain expensive database
operations so that in case of an overwhelming traffic event like a denial of
service (DOS) attack you have a way of both reducing load on the server and
saving legitimate users the frustration of getting white screens or losing form
submissions.

This is an API module. It doesn't do anything by itself. Rather, it provides
module developers the ability to define shunts and make functionality dependant
on them, and it gives site administrators the ability to enable and disable said
shunts via the web UI or Drush.


## Installation

Shunt module is installed in the usual way. See [Installing contributed
modules](https://www.drupal.org/documentation/install/modules-themes/modules-8).


## Usage

Shunts can be enabled and disabled via the web UI at admin/config/system/shunt
or via Drush. For a list of available Drush commands execute the following:

```bash
drush --filter=shunt
```


## Implementation

For instructions on defining shunts or shunt-enabling a module, see
shunt.api.php. For a working example see the included Shunt Example module.