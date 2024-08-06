# Sales Sequence Configurable Module for Magento 2

[![Latest Stable Version](https://img.shields.io/packagist/v/opengento/module-sales-sequence.svg?style=flat-square)](https://packagist.org/packages/opengento/module-sales-sequence)
[![License: MIT](https://img.shields.io/github/license/opengento/magento2-sales-sequence.svg?style=flat-square)](./LICENSE) 
[![Packagist](https://img.shields.io/packagist/dt/opengento/module-sales-sequence.svg?style=flat-square)](https://packagist.org/packages/opengento/module-sales-sequence/stats)
[![Packagist](https://img.shields.io/packagist/dm/opengento/module-sales-sequence.svg?style=flat-square)](https://packagist.org/packages/opengento/module-sales-sequence/stats)

This module allows to setup the sales sequence settings directly withing the configuration.

 - [Setup](#setup)
   - [Composer installation](#composer-installation)
   - [Setup the module](#setup-the-module)
 - [Features](#features)
 - [Settings](#settings)
 - [Documentation](#documentation)
 - [Support](#support)
 - [Authors](#authors)
 - [License](#license)

## Setup

Magento 2 Open Source or Commerce edition is required.

### Composer installation

Run the following composer command:

```
composer require opengento/module-sales-sequence
```

### Setup the module

Run the following magento command:

```
bin/magento setup:upgrade
```

**If you are in production mode, do not forget to recompile and redeploy the static resources.**

## Features

Setup the following sales sequence settings by entity types (order, invoice, creditmemo, shipment):
- Patter
- Suffix
- Prefix
- Start Value
- Step
- Warning Value
- Max Value

## Documentation

- The sequence profiles and meta are updated at every recurring setup, config update, new or deleted store.

## Support

Raise a new [request](https://github.com/opengento/magento2-sales-sequence/issues) to the issue tracker.

## Authors

- **Opengento Community** - *Lead* - [![Twitter Follow](https://img.shields.io/twitter/follow/opengento.svg?style=social)](https://twitter.com/opengento)
- **Thomas Klein** - *Maintainer* - [![GitHub followers](https://img.shields.io/github/followers/thomas-kl1.svg?style=social)](https://github.com/thomas-kl1)
- **Contributors** - *Contributor* - [![GitHub contributors](https://img.shields.io/github/contributors/opengento/magento2-sales-sequence.svg?style=flat-square)](https://github.com/opengento/magento2-sales-sequence/graphs/contributors)

## License

This project is licensed under the MIT License - see the [LICENSE](./LICENSE) details.

***That's all folks!***