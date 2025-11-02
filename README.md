## Description
This repository contains an implementation of a simple shopping cart system in PHP. The system has delivery rules and offers that can be applied to the cart.

## Requirements
- PHP 8.3 or higher
- Composer
- Docker

## Quick Start
1. Clone the repository:
   ```bash
   git clone
   ```
2. Install dependencies using Composer:
   ```bash
   docker compose run --rm composer
   ```
3. Run the application using Docker:
   ```bash
    docker compose run --rm app B01 G01
    ```
   
## Run locally without Docker
1. Ensure you have PHP 8.3 or higher and Composer installed.
2. Install dependencies:
   ```bash
   composer install
   ```
3. Run the application:
   ```bash
    php src/index.php B01 G01
    ```