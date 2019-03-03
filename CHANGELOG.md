# Rinvex Contacts Change Log

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](CONTRIBUTING.md).


## [v2.0.0] - 2019-03-03
- Rename environment variable QUEUE_DRIVER to QUEUE_CONNECTION
- Require PHP 7.2 & Laravel 5.8
- Apply PHPUnit 8 updates
- Tweak and simplify FormRequest validations

## [v1.0.2] - 2018-12-22
- Update composer dependencies
- Add PHP 7.3 support to travis

## [v1.0.1] - 2018-10-05
- Fix wrong composer package version constraints

## [v1.0.0] - 2018-10-01
- Enforce Consistency
- Support Laravel 5.7+
- Rename package to rinvex/laravel-contacts

## [v0.0.2] - 2018-09-22
- Update travis php versions
- Define polymorphic relationship parameters explicitly
- Require missing composer packages and tweak phone validation rule
- Require composer package rinvex/languages
- Simplify contact fields
- Require full name contact field
- Enforce consistency
- Add national_id field and soft deletes
- Update contact fields
- Tweak validation rules
- Drop StyleCI multi-language support (paid feature now!)
- Update composer dependencies
- Split full_name into given_name and family_name fields
- Add organization field for contacts
- Drop social fields from core package
- Prepare and tweak testing configuration
- Highlight variables in strings explicitly
- Update StyleCI options
- Update PHPUnit options
- Add contact model factory

## v0.0.1 - 2018-02-18
- Tag first release

[v2.0.0]: https://github.com/rinvex/laravel-contacts/compare/v1.0.2...v2.0.0
[v1.0.2]: https://github.com/rinvex/laravel-contacts/compare/v1.0.1...v1.0.2
[v1.0.1]: https://github.com/rinvex/laravel-contacts/compare/v1.0.0...v1.0.1
[v1.0.0]: https://github.com/rinvex/laravel-contacts/compare/v0.0.2...v1.0.0
[v0.0.2]: https://github.com/rinvex/laravel-contacts/compare/v0.0.1...v0.0.2
