# Capstone Project ( E-Gov Website )

## Introduction

This is project is an e-government website that dispatches or disclose all important information to the public. Like services, programs, and etc. Anything that a municipality can offer to the pubic.

## Objectives

The goal of this Project are to:

- enable the public to get or access all information from the municipality
- make the information to update realtime by providing an admin panel

## Dependencies

Before you work on this project make sure you have these following installed on your system.
- [VSCode](https://code.visualstudio.com/Download)
- [MySQL Workbench](https://dev.mysql.com/downloads/workbench/). 
- [PHP](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [Node](https://nodejs.org/en/download/)

## Installation

To install and run this project, follow these steps:

1. Make sure to install the composer into your system. Download composer here [composer](https://www.tutsmake.com/install-composer-windows/)
2. clone the repository `git clone https://github.com/ronrix/capstone-e-gov.git`
3. Change your branch `git branch -M develop`
4. Install dependencies by running these commands `composer install` and `npm install`. Make sure you already installed composer and nodejs
5. Run the project. `npm run dev` and `php artisan serve`. Make sure to run them both. 
6. To access the project go to `localhost:8000`
7. Run this to create dummy data `php artisan migrate:refresh --seed`. Make sure you have MySQL Workbench installed on your system
8. Make your changes
9. Add your changes. `git add <filename>` and commit it `git commit -m "Adding new feature"`
10. Push your changes: `git push origin develop`. Push only to develop branch.
11. Submit a pull request.

## Where to change Frontend Designs

Go to `resources > js`. There you can see Pages and Components folder where you can create frontends.
- This project uses VueJS for it's frontend. If you want to learn about it. Go to [documentation](https://vuejs.org/guide/introduction.html)

For css styling
- This project uses tailwind for css styles. Go to [tailwind](https://tailwindcss.com/docs/installation) if you want to learn more how to use it.
