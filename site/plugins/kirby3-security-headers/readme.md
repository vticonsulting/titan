# Kirby 3 Content Security Policy

![GitHub release](https://img.shields.io/github/release/bnomei/kirby3-security-headers.svg?maxAge=1800) ![License](https://img.shields.io/github/license/mashape/apistatus.svg) ![Kirby Version](https://img.shields.io/badge/Kirby-3%2B-black.svg) ![Kirby 3 Pluginkit](https://img.shields.io/badge/Pluginkit-YES-cca000.svg)

Kirby 3 Plugin for easier Security Headers setup.

> 🔐 Why should you use this plugin? Because security matters. Protecting your own or your clients websites and their customers data is important.

## Commerical Usage

This plugin is free but if you use it in a commercial project please consider to 
- [make a donation 🍻](https://www.paypal.me/bnomei/2.5) or
- [buy me ☕](https://buymeacoff.ee/bnomei) or
- [buy a Kirby license using this affiliate link](https://a.paddle.com/v2/click/1129/35731?link=1170)

## Installation

- unzip [master.zip](https://github.com/bnomei/kirby3-security-headers/archive/master.zip) as folder `site/plugins/kirby3-security-headers` or
- `git submodule add https://github.com/bnomei/kirby3-security-headers.git site/plugins/kirby3-security-headers` or
- `composer require bnomei/kirby3-security-headers`

## Dependencies

- https://github.com/Martijnc/php-csp

## Automatic Setup

A `route:before`-hook will take care of setting the headers automatically on all non localhost/webpack setups.

## Manual Setup

- Set `bnomei.securityheaders.route.before` to `false` in your config file.
- Set headers before dumping any other string.
- Do NOT leave a space between the snippet call and the doctype statement - because reasons.
- Read the [FAQs](https://github.com/bnomei/kirby3-security-headers/issues?q=is%3Aissue+is%3Aopen+label%3AFAQ).

```php
<?php
  snippet('plugin-securityheaders');
?><!DOCTYPE html>
<!-- ... -->
```

## Settings

All settings need to be prefiex with `bnomei.securityheaders.`.

**enabled**
- default: `true` will set headers

**enabled.panel**
- default: `false` will not set headers in panel

**route.before**
- default: `true` will set headers with a `route:before`-hook

**headers**
- default: array of sensible default values. modify as needed.

**csp**
- default: `null` will limit all content to current domain in setting `default-src`, `style-src`, `script-src`, `image-src`, `font-src` and `connect-src`. It will NOT add `unsave inline` or `unsave eval` – do use nonces and hashes instead.

**nonces**
- default: `[]` allows you to define plain text strings which will be randomized each page refresh to an unique base64 encoded string and defined in header. Use `$page->nonce('plain-string')` to retrieve the nonce.

> TIP: [kirby3-htmlhead](https://github.com/bnomei/kirby3-htmlhead) nonces are always defined.

**hashes**
- default: `[]` allows you to set valid hash definitions to headers.

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/bnomei/kirby3-security-headers/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
