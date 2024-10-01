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
- Pattern
- Suffix
- Prefix
- Add Store ID
- Start Value
- Step
- Warning Value
- Max Value

This module is an alternative to this package: https://github.com/karliuka/m2.SalesSequence.  
The main difference is that faonni/module-sales-sequence allows to manage sales sequences profile as an entity, whereas 
our module achieve it via settings you can edit from the scoped configuration.  

If you enable the store ID, it will be added a the fourth argument in the pattern. We recommend you to use the numered argument syntax (%4$s) in order to the position of your choice in the pattern.  

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
