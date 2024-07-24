Google Calendar Integration Project
Overview
This project is a simple PHP-based application that allows users to connect their Google Calendar and perform the following actions:
#List events
#Create events
#Delete events
#Disconnect the account

Prerequisites
#PHP 7.4 or higher
#Composer
#Google API Client Library for PHP

Setup Instructions
Clone the repository and install the required dependencies using Composer:
bash
Copy code
git clone https://github.com/IchchhaD/intuji-assignment.git
cd <repository-directory>
composer install

FILE STRUCTURE
/intuji-assignment
    /config
      auth.php
      config.php
    /core
        calendar.php
        disconnect.php
    /includes
      header.php
    /public
      /css
        style.php
    /vendor
      /....
      autoload.php
    /views
      create.php
      list.php
    index.php
    composer.json
    composer.lock
    README.md

