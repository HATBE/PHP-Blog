# Feautures

- Markdown Support
- User Management
- Installer
# Installation

Base OS: Ubuntu-server 20.04

## LAMP

``` bash
$ sudo apt update
```

As the Webserver, a Apache2 is used.

``` bash
$ sudo apt install apache2
```

As the Database server, a MariaDB is used.

``` bash
$ sudo apt install mariadb-server
$ sudo mariadb-secure-installation
Enter current password for root (enter for none): ENTER
Switch to unix_socket authentication [Y/n]: N
Change the root password? [Y/n] N
Remove anonymous users? [Y/n] Y
Disallow root login remotely? [Y/n] Y
Remove test database and access to it? [Y/n] Y
Reload privilege tables now? [Y/n] Y
```  

PHP Installation.

``` bash
$ sudo apt install php libapache2-mod-php php-gmp php-curl php-gd php-mysql php-mbstring php-bcmath php-imagick php-xml php-zip
```

Now we can prepare the System.

``` bash
$ sudo systemctl reload apache2
```

## Install the Blog

Create the Database.

``` bash
$ sudo mysql -u root -p
```

``` SQL
CREATE DATABASE blog;
CREATE USER bloguser IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON blog.* TO bloguser;
EXIT;
```

``` bash
$ cd /var/www/html
$ sudo rm index.html
$ sudo git clone https://github.com/HATBE/Blog.git .
$ sudo chmod 755 /var/www/html -R
$ sudo chown www-data:www-data /var/www/html -R
$ sudo nano /etc/apache2/sites-available/000-default.conf
change -> DocumentRoot from "/var/www/html" to " /var/www/html/public"
Add: 
-- <Directory /var/www/html/public>
--        AllowOverride All
--</Directory>
sudo a2enmod rewrite
$ sudo systemctl reload apache2
```

Now, you can navigate to https://<ip/host> in your browser.

Follow the instructions of the installer.

Standard credentials:
Username: admin
Password: 1234
