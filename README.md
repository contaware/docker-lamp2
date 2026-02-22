# LAMP2 stack built with Docker Compose

A LAMP (Linux Apache MySQL PHP) stack environment built using Docker Compose. It's called LAMP2 because you can choose between two database servers. This stack is meant for local development and not for production usage. It runs simultaneously:

- An Apache web server with configurable PHP version and Xdebug support
- A database server, choose between MySQL and MariaDB
- phpMyAdmin


## Installation

Clone this repository to your local computer:

```bash
git clone https://github.com/contaware/docker-lamp2.git
```


## Usage and Configuration

### Start servers

1. Enter the project directory: `cd docker-lamp2/`
2. Run: `docker compose up -d` 

### Stop servers

1. Enter the project directory: `cd docker-lamp2/`
2. Run: `docker compose down`

### After configuration changes

1. Enter the project directory: `cd docker-lamp2/`
2. Run: `docker compose down`
3. If *./compose.yaml* has been changed, run:  
   `docker compose up -d`  
   If a *Dockerfile* has been changed, run:  
   `docker compose up -d --build`

### Web Server and PHP

The apache server is listening on <http://localhost:8888>. Change the port in *./compose.yaml* file.

The PHP version is selected in *./compose.yaml* by providing the *Dockerfile* corresponding to the wanted version.

To prevent common warnings, edit *./php_conf/error_reporting.ini* like:

```
error_reporting=E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
```
- Note: since PHP 8.4 `E_STRICT` is not used anymore.

Place your web project files into the *./html/* directory, the resulting owner in the container should be **www-data** (the apache server runs as this user) and usually that user should have write permissions. If that's not the case, while the apache server is running, correct your files by opening a container shell:

```bash
docker compose exec -u root web /bin/bash
```

and in the container shell run the following commands:

```bash
# Change the owner to www-data 
chown -R www-data:www-data /var/www/html/

# Update permissions
find /var/www/html/ -type f ! -perm 644 -exec chmod 644 {} +
find /var/www/html/ -type d ! -perm 755 -exec chmod 755 {} +
```

### Database Server

By default the database server is configured to listen on port **3306**. Access the database server with the **db** hostname, see *./html/index.php* for an example. The databases are stored under *./db_data/*.

Other than the **root** user, there is also a **blog** user with a **blogdb** database. Both **root** and **blog** have the **1234** password. Server version, port and passwords can be changed in *./compose.yaml*. When changing database server or version, it may be necessary to start with no databases, for that delete the *./db_data/* directory.

### phpMyAdmin

phpMyAdmin is accessed through <http://localhost:8080>. Use the credentials reported in the previous section.

Change version and port in *./compose.yaml*.
