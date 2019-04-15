Custom PHPStan Rules
====================

Collection of custom PHPStan rules.

:warning: This is just a Proof of Concept

Installation
------------

```bash
composer require --dev brumann/phpstan-rules
```

Usage
-----

See https://github.com/phpstan/phpstan#custom-rules

Rules
-----

**ConstructorPreferInterface**

This Rule ensures that when a constructor argument is an object, type hints are for an appropriate interface, instead
of a concrete implementation.
