# SPTarkov Fika Raid Info

This project is a web interface to display current SPTarkov Fika raids. It uses PHP and composer to handle its dependencies. The site provides a visual representation of various raids and their data, sourced from the server.

![Preview of web interface](assets/images/preview.png)

## Requirements

Before deploying the project, ensure you have the following:

- **Docker** and **Docker Compose** installed.
- Alternatively, you can use PHP (version 8.1 or higher) and a web server like Apache or Nginx, though Docker simplifies the process.

## Installation

The easiest way to get this project running is by using Docker Compose. Follow these steps:

### 1. Copy `docker-compose.yml` to the Server 

The `docker-compose.yml` file can be found [here](https://github.com/Rambomst/sptarkov-fika-raid-info-viewer/blob/master/docker-compose.yml)

### 2. Start the Application Using Docker

```bash
docker compose up -d --remove-orphans
```

This will automatically set up the necessary environment and dependencies. Your application will be available at `http://localhost` by default.

## Manual Setup (Optional - Unsupported)

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





### Configuring the Web Server to Route All Requests Through `index.php`

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
           try_files $uri $uri/ /index.php?$args;
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

## Contributing

Feel free to fork this repository and submit pull requests. Any help to improve this project is welcome.
