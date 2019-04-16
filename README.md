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

To enable all rules with their default configuration you can just include the provided `rules.neon` file in your
`phpstan.neon` like this:

```yaml
includes:
    - vendor/brumann/phpstan-rules/rules.neon
```

If you want to enable only selective rules you can also manually configure the rules in your `phpstan.neon` as
is described in the docs: https://github.com/phpstan/phpstan#custom-rules

Rules
-----

**ConstructorPreferInterface**

This Rule ensures that when a constructor argument is an object, type hints are for an appropriate interface, instead
of a concrete implementation. Optionally you can provide a list of Interfaces to be ignored.
