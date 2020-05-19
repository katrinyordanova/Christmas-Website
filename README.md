Christmas Website
=========

A simple e-commerce website built with Symfony.

### More Info
This is a shop for purchasing Christmas items - trees, garlands, toys, decorations and many more.
The application consists of three parts - admin, guest and user. The admin can manage purchases, fix issues and delete
users if necessarily. A guest can see all of the items, but can't buy them. Only a user can buy items. To become a user
you must register or login.

Installation
=========
[Download Symfony](https://symfony.com/download) to install the symfony binary on your computer and run this command:

```
$ symfony new --christmas-website
```

Alternatively, you can use Composer:

```
$ composer create-project symfony/symfony-christmas-website my_project
```

Usage
=========

After installing Symfony go to the directory of the project

```
$ cd my_project
```

To start the server write:

```
$ symfony serve
```
