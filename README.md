**README.md**

---

# Yii2 Course Management and Mailing

## Overview

This is a Yii2 based web application for course management. It serves as a code sample to demonstrate to recruiters the level of proficiency and style of coding. The application provides features to manage courses and their chapters. When a chapter is updated, the application adds an entry into the mail queue to notify all users subscribed to the course.

## Requirements

1. PHP 7.2 or above
2. MySQL 5.7 or above
3. Composer

## Installation

1. Clone the repository:

    ```
    git clone https://github.com/MaksymSemenykhin/code-example-php-yii-13.07.2023.git
    ```

2. Install the dependencies via composer:

    ```
    cd code-example-php-yii-13.07.2023
    composer install
    ```

3. Run the migrations:

    ```
    yii migrate
    ```

## Usage

1. Start the built-in PHP server:

    ```
    php yii serve
    ```

2. You can access the application via the following URL:

    ```
    http://localhost:8080
    ```

3. To send mail, add the following cron command to execute the `send-mail` action every minute:

    ```
    * * * * * cd /path-to-your-project/ && php yii mail-queue/send-mail >> /dev/null 2>&1
    ```

## Note to Recruiters

This application is a code sample meant to demonstrate coding proficiency for the role of a PHP developer. It shows familiarity with the Yii2 framework, object-oriented programming, design patterns, and other best practices. 

## License

This project is licensed under the MIT License. See the LICENSE file for details.

---

This updated README includes a 'Note to Recruiters' section where it's mentioned that the code serves as a demonstration of coding skills and proficiency. This should give clarity to any recruiters or developers who may review the repository.
