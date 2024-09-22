# SPTarkov Fika Raid Info

This project is a web interface to display current SPTarkov Fika raids. It uses PHP and composer to handle its dependencies. The site provides a visual representation of various raids and their data, sourced from the server.

![Preview of web interface](assets/images/preview.png)

## Requirements

Before deploying the project, ensure you have the following installed:

- **PHP** (version 8.1 or higher recommended)
- A web server like **Apache** or **Nginx**
- **Composer** for managing dependencies - [Composer](https://getcomposer.org/)

## Installation

To get this project up and running, follow these steps:

### 1. Clone the Repository

```bash
git clone https://github.com/Rambomst/sptarkov-fika-raid-info-viewer.git
cd sptarkov-fika-raid-info-viewer
```

### 2. Install Dependencies

The project uses `composer` for managing PHP dependencies. Ensure you have [Composer](https://getcomposer.org/) installed.

```bash
composer install
```

### 3. Configure the Project

Create a `config.json` using the `config.example.json` file as a template with the correct values before deploying the project.

```json
{
    "ui": {
        "title": "SPTarkov Fika Match List"
    },
    "tarkov": {
        "host": "1.1.1.1",
        "port": "6969",
        "dedicated_clients": [
            "XXXXX"
        ]
    }
}
```

#### Configurable Options:

- **ui.title**: Set the title of the web interface (e.g., "SPTarkov Fika Match List").
- **tarkov.host**: The host IP for the Fika server.
- **tarkov.port**: The port used by the server.
- **tarkov.dedicated_clients**: A list of dedicated client IDs which will be excluded from the player list and counts.

You need to replace the `XXXXX` in `dedicated_clients` with actual client IDs for your environment.

### 4. Run the Application

Once the configuration is complete, the application is ready to run on your web server.

You can use any PHP server or set up an Apache/Nginx environment to serve the files.

## Configuring the Web Server to Route All Requests Through `index.php`

This project uses FastRoute to handle URL routing, which means all requests should be directed to `index.php`. Below are the instructions for configuring both Apache and Nginx to achieve this.

### Apache Configuration

For Apache, you will need to enable mod_rewrite and update the `.htaccess` file to ensure all requests are routed through `index.php`.

1. Ensure `mod_rewrite` is enabled in Apache:
   ```bash
   a2enmod rewrite
   ```

2. Add or update the `.htaccess` file in the root of your project directory with the following content:
   ```apache
   <IfModule mod_rewrite.c>
       RewriteEngine On
       RewriteBase /

       # Redirect all requests to index.php
       RewriteCond %{REQUEST_FILENAME} !-f
       RewriteCond %{REQUEST_FILENAME} !-d
       RewriteRule ^ index.php [L]
   </IfModule>
   ```

3. Ensure the Apache configuration for your site allows `.htaccess` files:
   ```apache
   <Directory /path/to/your/project>
       AllowOverride All
   </Directory>
   ```

### Nginx Configuration

For Nginx, you can configure the server to route all requests to `index.php` by modifying the server block configuration.

1. Open the Nginx configuration file for your site.

2. Update the `location` block to pass all requests that aren't for existing files or directories to `index.php`:
   ```nginx
   server {
       listen 80;
       server_name your-domain.com;
       root /path/to/your/project;

       index index.php;

       location / {
           try_files $uri /index.php$is_args$args;
       }

       location ~ \.php$ {
           include snippets/fastcgi-php.conf;
           fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
           include fastcgi_params;
       }
   }
   ```

3. Reload Nginx to apply the changes:
   ```bash
   sudo systemctl reload nginx
   ```

After making these changes, all requests to your site will be routed through `index.php`, allowing FastRoute to handle the routing logic.

## Updating Dependencies

To update the composer dependencies, run:

```bash
composer update
```

This will fetch and install the latest versions of the dependencies defined in the `composer.json` file.

## Deploying on Windows

To deploy this project on a Windows machine, follow these steps:

### 1. Install PHP

You can install PHP on Windows using one of the following methods:

- **Using XAMPP**: This is the easiest method, as XAMPP comes pre-packaged with PHP and Apache.
  1. Download and install [XAMPP](https://www.apachefriends.org/index.html).
  2. During installation, ensure both **Apache** and **PHP** are selected.
  3. Once installed, you can manage the Apache server using the XAMPP Control Panel.

- **Manual PHP Installation**:
  1. Download PHP from [php.net](https://windows.php.net/download).
  2. Extract the PHP files to `C:\php`.
  3. Add `C:\php` to your system's PATH environment variable.
  4. Verify the installation by running `php -v` in the command prompt.

### 2. Install Composer

Composer is required to manage PHP dependencies.

1. Download the [Composer installer](https://getcomposer.org/Composer-Setup.exe).
2. Run the installer and follow the prompts. Ensure that PHP is added to your PATH so that Composer can detect it.
3. Verify the installation by running `composer -v` in the command prompt.

### 3. Configure a Web Server

You can either use the web server provided by XAMPP (Apache) or manually set up Apache or Nginx.

#### XAMPP (Apache)
1. Place your project files in the `htdocs` directory inside your XAMPP installation (usually located at `C:\xampp\htdocs`).
2. Start Apache from the XAMPP Control Panel.
3. Navigate to `http://localhost/your-project-directory` in your browser to view your site.

#### Manual Apache/Nginx Installation
If you choose not to use XAMPP, you can manually install and configure **Apache** or **Nginx**. Refer to their respective installation guides for Windows:
- [Apache for Windows](https://httpd.apache.org/docs/current/platform/windows.html)
- [Nginx for Windows](https://nginx.org/en/docs/windows.html)

### 4. Install Project Dependencies

Once PHP and Composer are installed, navigate to your project directory in the command prompt and run:

```bash
composer install
```

This will install all the necessary dependencies for the project.

### 5. Update Configuration

Before running the project, update the `config.json` file with the correct values:

```json
{
    "ui": {
        "title": "SPTarkov Fika Match List"
    },
    "tarkov": {
        "host": "1.1.1.1",
        "port": "6969",
        "dedicated_clients": [
            "XXXXX"
        ]
    }
}
```

### 6. Run the Application

After everything is installed and configured, you can access the site locally:

- If using **XAMPP**, navigate to `http://localhost/your-project-directory`.
- If using **Apache/Nginx** manually, follow the configuration for your respective web server and point it to your project directory.

The site should now be running, and you can view the raid information interface.

## Contributing

Feel free to fork this repository and submit pull requests. Any help to improve this project is welcome.
