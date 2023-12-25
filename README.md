
<h1>
    Investments Dashboard - Symfony
</h1>

## Description

This project is a dashboard for investments. It is a simple project to learn Symfony.

## Requirements

- PHP 8.2
- Composer
- Docker
- Docker Compose

## Installation

### To install the project, run the following command:

```bash
    composer install
    npm install
```

## 

# Docker Compose for the Database

## Usage

With this command, the database will be started in the background.

```bash
    docker compose up -d database
```

## Configuration

The database is configured in the file `docker-compose.yml`.

###

The database is configured with the following environment variables:

- `MYSQL_ROOT_PASSWORD`: password
- `MYSQL_DATABASE`: investments_symfony
- `PORT`: 3307:3306


### To add the fixtures, run the following command:

```
    php bin/console doctrine:fixtures:load
``````

##

### To stop the database, run the following command:

<code>
    docker compose down
</code>