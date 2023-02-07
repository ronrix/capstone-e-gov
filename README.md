# Capstone Project ( E-Gov Website )

## Introduction

This is project is an e-government website that dispatches or disclose all important information to the public. Like services, programs, and etc. Anything that a municipality can offer to the pubic.

## Objectives

The goal of this Project are to:

- enable the public to get or access all information from the municipality
- make the information to update realtime by providing an admin panel

## Installation

To install and run this project, follow these steps:

1. Make sure to install the composer into your system. Download composer here [composer](https://www.tutsmake.com/install-composer-windows/)
2. clone the repository `git clone https://github.com/ronrix/capstone-e-gov.git`
3. Change your branch `git branch -M develop`
4. Install dependencies of vendors and node_modules by running these commands `composer install` and `npm install`. Make sure you already installed composer and nodejs
5. Run the project. `npm run dev` and `php artisan serve`. Make sure to run them both. To access the project go to the link of what php artisan server is and not the server vite provided.
6. To create the dummy data. Run this command. `php artisan migrate:refresh --seed`. Make sure you have mysql installed on your system.
7. Make your changes
8. Commit your changes: `git commit -m "Adding new feature"`
9. Push your changes: `git push origin develop`
10. Submit a pull request

## Folder structure

To make changes with the frontend designs, go to these folders:
- `resources > views`

Inside views folder, there are folders where to save the frontend files
- `components`. Typically contains reusable views with the same designs or styles. A component can accept data and render it in a specific way. This can be access by doing this `<x-card></x-card>`.
- `pages`. This is where you put all the pages of the webapp. Like dashboard, login page, settings page, and etc.
- `partials`. Typically contains reusable views same as components, but a partials can't accept data. E.g footer, header, and, etc. This can be access by `@include('_partial_name')`. The conventional naming of this should be like this `'_filename.php'` shoub be prefixed with `_` underscore.


## Docker Container

To install and run this project with docker
Make sure you have WSL2 enabled and installed ubuntu on your system

1. Install docker desktop in your machine [docker](https://docs.docker.com/desktop/install/windows-install/)
2. Clone the repository `git clone https://github.com/ronrix/capstone-e-gov.git`
3. Run this command `composer install` if this gives error try this `composer install --ignore-platform-reqs`
4. `php artisan sail:install`
5. `./vendor/bin/sail up`
6. `./vendor/bin/sail npm run dev`
7. After that just go to `http://localhost/`

Make sure you don't have any running services with port 80. If you have apache2 running kill it with `systemctl stop apache2`
or if you have XAMPP or WAMP. stop it from running.
