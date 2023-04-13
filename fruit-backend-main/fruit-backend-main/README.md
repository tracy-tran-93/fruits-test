# Fruit Backend (Symfony) Guildline
### PHP 8.1
### Symfony 6.2
This is the back-end API repository for Fruit website <br>
**Notice**: Please cd to BE project folder before you run any command

Current version: `1.0`

## Project Configuration
- Step 1: Install package for symfony<br>
*Notice: Please install lastest composer*
```
composer install
```
- Step 2: Config database connection
```
Open .env file
Update value of DATABASE_URL to your own local database like:
DATABASE_URL="mysql://{username}:{password}@{host}:{port}/{database name}?serverVersion=8&charset=utf8mb4"
```
- Step 3: Create database
```
php bin/console doctrine:database:create
```
- Step 4: Run migration to create table
```
php bin/console doctrine:migrations:migrate
```

## Script Command To Fetch Data From fruityvice.com

### Config Mailtrap to send and receive email
- Step 1: Access https://mailtrap.io/ and login (or register new account and login)
- Step 2: In Home, Click ``Start Testing`` button in ``Email Testing`` section
- Step 3: In ``SMTP Setting`` tab, below ``Integrations`` text, choose `Symfony 5+` in selectbox
- Step 4: Copy generated text to `MAILER_DSN` in env file.
- Step 5: Update `MAIL_FROM` and `MAIL_TO`
- 
### Script Command
```
php bin/console fruits:fetch
```

## Run BE server local to provide API for FE
```
symfony server:start
```

## Change Log
[CHANGELOG.md](CHANGELOG.md)
