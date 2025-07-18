# LAMP2 stack built with Docker Compose

A simple LAMP2 (Linux Apache MySQL MariaDB PHP) stack environment built using Docker Compose. It is meant for local development and not for production usage. It consists of:

- PHP
- Apache
- Dual MySQL and MariaDB
- phpMyAdmin (it's possible to choose between MySQL and MariaDB)


## Installation

Clone this repository to your local computer:

```shell
git clone https://github.com/contaware/docker-lamp2.git
```


## Usage and Configuration

### Start servers

1. Enter the project directory: `cd docker-lamp2/`
2. Run `docker compose up -d` 

### Stop servers

1. Enter the project directory: `cd docker-lamp2/`
2. Run `docker compose down`

### After configuration changes

1. Enter the project directory: `cd docker-lamp2/`
2. Run `docker compose down`
3. If only *./compose.yaml* has been changed:  
   `docker compose up -d`  
   If *./Dockerfile* has been changed:  
   `docker compose up -d --build`

### Web Server and PHP

Apache is set to run on port **8888**, access it through <http://localhost:8888>. Change the port in *./compose.yaml* file.

Place your web project files into *./html*.

The installed PHP version along the extensions can be configured in *./Dockerfile* file.

### Database Servers

MySQL and MariaDB are both configured to listen on port **3306**, they can run at the same time because they are on different containers with different IPs. Access the servers with the **mysqldb** and the **mariadb** hostnames, see *./html/index.php* for an example. The databases are stored under *./mysqldb_data/* and *./mariadb_data/*.

Other than the **root** user, there is also a **blog** user with a **blogdb** database. Both **root** and **blog** have the **1234** password. Servers version, ports and passwords can be changed in *./compose.yaml*. But note that in some cases it may be necessary to start with no databases, for that delete the *./mysqldb_data/* and *./mariadb_data/* directories.

### phpMyAdmin

phpMyAdmin is configured to run on port **8080**, access it through <http://localhost:8080>. Either select MySQL or MariaDB and use the credentials reported in the previous section.

Change version and port in *./compose.yaml*.
