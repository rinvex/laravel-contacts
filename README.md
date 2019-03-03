# Rinvex Contacts

**Rinvex Contacts** is a polymorphic Laravel package, for contact management system. You can add contacts to any eloquent model with ease.

[![Packagist](https://img.shields.io/packagist/v/rinvex/laravel-contacts.svg?label=Packagist&style=flat-square)](https://packagist.org/packages/rinvex/laravel-contacts)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/rinvex/laravel-contacts.svg?label=Scrutinizer&style=flat-square)](https://scrutinizer-ci.com/g/rinvex/laravel-contacts/)
[![Code Climate](https://img.shields.io/codeclimate/github/rinvex/laravel-contacts.svg?label=CodeClimate&style=flat-square)](https://codeclimate.com/github/rinvex/laravel-contacts)
[![Travis](https://img.shields.io/travis/rinvex/laravel-contacts.svg?label=TravisCI&style=flat-square)](https://travis-ci.org/rinvex/laravel-contacts)
[![StyleCI](https://styleci.io/repos/97991812/shield)](https://styleci.io/repos/97991812)
[![License](https://img.shields.io/packagist/l/rinvex/laravel-contacts.svg?label=License&style=flat-square)](https://github.com/rinvex/laravel-contacts/blob/develop/LICENSE)


## Installation

1. Install the package via composer:
    ```shell
    composer require rinvex/laravel-contacts
    ```

2. Execute migrations via the following command:
    ```
    php artisan rinvex:migrate:contacts
    ```

3. **Optional** if you want to change the configurations:
    ```shell
    php artisan rinvex:publish:contacts
    ```

4. Done!


## Usage

To add contacts support to your eloquent models simply use `\Rinvex\Contacts\Traits\HasContacts` trait.

### Manage your contacts

```php
// Get instance of your model
$user = new \App\Models\User::find(1);

// Create a new contact
$user->contacts()->create([
    'given_name' => 'Abdelrahman',
    'family_name' => 'Omran',
    'title' => 'Software Architect',
    'organization' => 'Rinvex',
    'email' => 'me@omranic.com',
    'phone' => '+201228160181',
    'source' => 'website',
    'method' => 'call',
    'country_code' => 'eg',
    'language_code' => 'en',
    'birthday' => '1987-06-18',
    'gender' => 'male',
]);

// Create multiple new contacts
$user->contacts()->createMany([
    [...],
    [...],
    [...],
]);

// Find an existing contact
$contact = app('rinvex.contacts.contact')->find(1);

// Update an existing contact
$contact->update([
    'email' => 'iOmranic@gmail.com',
]);

// Delete contact
$contact->delete();

// Alternative way of contact deletion
$user->contacts()->where('id', 123)->first()->delete();

// Get relative contacts collection
$user->relatives;

// Get relative contacts query builder
$user->relatives();

// Get back relative contacts collection
$user->backRelatives;

// Get back relative contacts query builder
$user->backRelatives();

// Get attached contacts collection
$user->contacts;

// Get attached contacts query builder
$user->contacts();
```


## Changelog

Refer to the [Changelog](CHANGELOG.md) for a full history of the project.


## Support

The following support channels are available at your fingertips:

- [Chat on Slack](https://bit.ly/rinvex-slack)
- [Help on Email](mailto:help@rinvex.com)
- [Follow on Twitter](https://twitter.com/rinvex)


## Contributing & Protocols

Thank you for considering contributing to this project! The contribution guide can be found in [CONTRIBUTING.md](CONTRIBUTING.md).

Bug reports, feature requests, and pull requests are very welcome.

- [Versioning](CONTRIBUTING.md#versioning)
- [Pull Requests](CONTRIBUTING.md#pull-requests)
- [Coding Standards](CONTRIBUTING.md#coding-standards)
- [Feature Requests](CONTRIBUTING.md#feature-requests)
- [Git Flow](CONTRIBUTING.md#git-flow)


## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to [help@rinvex.com](help@rinvex.com). All security vulnerabilities will be promptly contacted.


## About Rinvex

Rinvex is a software solutions startup, specialized in integrated enterprise solutions for SMEs established in Alexandria, Egypt since June 2016. We believe that our drive The Value, The Reach, and The Impact is what differentiates us and unleash the endless possibilities of our philosophy through the power of software. We like to call it Innovation At The Speed Of Life. That’s how we do our share of advancing humanity.


## License

This software is released under [The MIT License (MIT)](LICENSE).

(c) 2016-2019 Rinvex LLC, Some rights reserved.
