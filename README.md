# Newsletter
## Subscription landing page

Demo (landing page):
https://interstellarcloud.space/newsletter/

Demo (admin area):
https://interstellarcloud.space/newsletter/admin/

- Vue 3
- SASS
- Axios
- PHP 7
- MySQL

# Installation
#### Source files
```
git clone https://github.com/r2020andx/newsletter.git
```

#### MySQL database setup
```
CREATE DATABASE IF NOT EXISTS newsletter;
USE newsletter;
CREATE TABLE emails
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  email TEXT,
  date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) 
ENGINE=InnoDB;
INSERT INTO 
	emails(email)
VALUES
	('skyline@example.com'),
	('sky@gmail.com'),
	('line@gmail.com');
```

# Configuration

#### Included settings file has four variables. Home directory must be edited if the project is not hosted on document root - example.com/welcome

`/config/settings.php`
 
```
<?php

$homeDir = '/';        // Home directory. Examples: '/', '/home', '/welcome'
$title = 'Welcome';
$isProduction = false;
$cssFileName = 'style.css';
```
#### Database connection parameters. 

`/config/db.php`

```
<?php

$host = "127.0.0.1";
$usr = "root";
$pwd = "";
$db = "newsletter";
$table = "emails";
```

#### Project requires following .htaccess configuration
```
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f

RewriteRule ^([^/]+)/? index.php?url=$1 [L,QSA]
```
