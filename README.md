[![Build Status](https://scrutinizer-ci.com/g/maciejslawik/reactphp-playground-magento2/badges/build.png?b=master)](https://scrutinizer-ci.com/g/maciejslawik/reactphp-playground-magento2/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/maciejslawik/reactphp-playground-magento2/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maciejslawik/reactphp-playground-magento2/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/mslwk/module-reactphp-playground/v/stable)](https://packagist.org/packages/mslwk/module-reactphp-playground)
[![License](https://poser.pugx.org/mslwk/module-reactphp-playground/license)](https://packagist.org/packages/mslwk/module-reactphp-playground)

# Magento 2 ReactPHP Playground #

Magento 2 module which showcases how to run resource-heavy processes asynchronously using
multiple threads with ReactPHP ChildProcess and HttpClient libraries.

## Prerequisites ##

* Magento 2.2 or higher
* PHP 7.1

## Installing ##

You can install the module by downloading a .zip file and unpacking it inside
``app/code/MSlwk/ReactPhpPlayground`` directory inside your Magento
or via Composer (recommended).

To install the module via Composer simply run
```
composer require mslwk/module-reactphp-playground
```

Than enable the module by running these command in the root of your Magento installation
```
bin/magento module:enable MSlwk_ReactPhpPlayground
bin/magento setup:upgrade
```

## Usage ##

#### Non-Magento scripts ####

The module contains PHP CLI scripts which don't require Magento. They present the potential differences
between the same calculations run on 1, 2 and 4 threads.

* To run HttpClient example start the ``Standalone/bin/http`` script
* To run ChildProcess example start the ``Standalone/bin/childprocess`` script

#### Magento commands ####

The module contains 2 commands available via ``bin/magento``. You can choose the number of threads to use.

* To run HttpClient example use
```
bin/magento mslwk:webapi-reporting-start <<number_of_threads>>
```

* To run ChildProcess example use
```
bin/magento mslwk:cli-reporting-start <<number_of_threads>>
```

## Authors

* **Maciej Sławik** - https://github.com/maciejslawik

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details 

## Screenshots

![Alt text](docs/standalone_cli.png?raw=true "Standalone script using ChildProcess run on 1, 2 and 4 threads")

![Alt text](docs/magento_cli_1.png?raw=true "Magento script using ChildProcess run on 1 thread")

![Alt text](docs/magento_cli_3.png?raw=true "Magento script using ChildProcess run on 3 threads")