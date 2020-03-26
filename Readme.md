## Project One

Team ice_cube

Shijie Feng - donfeng97@csu.fullerton.edu

Ying Wen- ywen1306@csu.fullerton.edu

Shalom Yemane - syemane@csu.fullerton.edu

Lily Tran - derpyhooves@csu.fullerton.edu

## Setup

Download Apache from [Download - The Apache HTTP Server Project](https://httpd.apache.org/download.cgi)


### `sudo apachectl start`
### `sudo nano /etc/apache2/httpd.conf `

You’ll need to remove # before LoadModule php5

### `sudo apachectl restart`
### `sudo nano /etc/apache2/httpd.conf`

Add index.php in DirectoryIndex line

### `sudo apachectl restart`


Download PHP from https://www.php.net/downloads

Download MySQL from [MySQL :: Download MySQL Community Server](https://dev.mysql.com/downloads/mysql/)

Choose the appropriate download for your system<br />
Remember to save your password


### `sudo mkdir /var/mysql`
### `sudo ln -s /tmp/mysql.sock /var/mysql/mysql.sock`

Start your MySQL server

### `cd /usr/local/mysql/bin`
### `sudo ./mysql -u root -p`



Download phpMyAdmin [phpMyAdmin - Downloads](https://www.phpmyadmin.net/downloads/) <br />
Copy and paste it into Documents folder <br />
Rename the folder to phpMyAdmin <br />

### `cd /Library/Webserver/Documents`
### `cd phpMyAdmin`
### `sudo mkdir config`
### `sudo chmod o+x config`

Open localhost/phpMyAdmin/setup, set up a new server <br />
Download Config<br />
Copy/Paste config into config folder<br />
Create the database and tables accordingly<br />

Download the project ZIP file<br />
Unzip the folder<br />

Move the folder to ~/Library/Documents/Webserver<br />
Go to localhost/CPSC349-ProjectOne/register.php<br />
