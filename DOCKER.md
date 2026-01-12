# RescueNet Docker Setup

This Laravel application is fully dockerized for easy deployment and development.

## 🐳 Quick Start

### Prerequisites

-   Docker (v20.10+)
-   Docker Compose (v2.0+)

### Setup

1. **Run the setup script:**

    ```bash
    chmod +x docker-setup.sh
    ./docker-setup.sh
    ```

    The script will automatically configure your `.env` file for Docker.

    Or manually:

2. **Copy environment file:**

    ```bash
    cp .env.example .env
    ```

3. **Update `.env` for Docker:**

    Uncomment and update the following lines:

    ```env
    # Change from:
    DB_CONNECTION=sqlite

    # To:
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=rescuenet
    DB_USERNAME=rescuenet
    DB_PASSWORD=rescuenet

    # Also update Redis:
    REDIS_HOST=redis
    CACHE_STORE=redis
    ```

4. **Update database credentials if needed:**

    - Set `APP_KEY` (will be generated)
    - Update database credentials if needed
    - Configure other services

5. **Build and start containers:**

    ```bash
    docker-compose build
    docker-compose up -d
    ```

6. **Generate application key:**

    ```bash
    docker-compose exec app php artisan key:generate
    ```

7. **Run migrations:**

    ```bash
    docker-compose exec app php artisan migrate --seed
    ```

8. **Create storage link:**
    ```bash
    docker-compose exec app php artisan storage:link
    ```

## 📦 Services

The application runs with the following services:

| Service       | Container Name  | Port | Description         |
| ------------- | --------------- | ---- | ------------------- |
| App (PHP-FPM) | rescuenet_app   | 9000 | Laravel application |
| Nginx         | rescuenet_nginx | 8080 | Web server          |
| MySQL         | rescuenet_db    | 3306 | Database            |
| Redis         | rescuenet_redis | 6379 | Cache & Queue       |

## 🌐 Accessing the Application

-   **Web:** http://localhost:8080
-   **API:** http://localhost:8080/api

## 🛠️ Common Commands

### Container Management

```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# Stop and remove volumes
docker-compose down -v

# View running containers
docker-compose ps

# View logs
docker-compose logs -f

# View specific service logs
docker-compose logs -f app
docker-compose logs -f nginx
```

### Laravel Artisan Commands

```bash
# Run artisan commands
docker-compose exec app php artisan <command>

# Examples:
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:list
```

### Composer Commands

```bash
# Install dependencies
docker-compose exec app composer install

# Update dependencies
docker-compose exec app composer update

# Require package
docker-compose exec app composer require vendor/package
```

### Database Commands

```bash
# Access MySQL CLI
docker-compose exec db mysql -u rescuenet -p rescuenet

# Backup database
docker-compose exec db mysqldump -u rescuenet -p rescuenet > backup.sql

# Restore database
docker-compose exec -T db mysql -u rescuenet -p rescuenet < backup.sql
```

### Shell Access

```bash
# Access app container
docker-compose exec app bash

# Access as www-data user
docker-compose exec -u www-data app bash

# Access database container
docker-compose exec db bash

# Access nginx container
docker-compose exec nginx sh
```

### File Permissions

```bash
# Fix storage permissions
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/storage

# Fix bootstrap cache permissions
docker-compose exec app chown -R www-data:www-data /var/www/html/bootstrap/cache
docker-compose exec app chmod -R 775 /var/www/html/bootstrap/cache
```

## 🔧 Development Mode

For development with hot reload:

1. **Update `docker-compose.yml`:**

    ```yaml
    app:
        environment:
            - APP_ENV=local
            - APP_DEBUG=true
    ```

2. **Restart containers:**
    ```bash
    docker-compose down
    docker-compose up -d
    ```

## 🚀 Production Deployment

### Build for Production

```bash
# Build optimized image
docker-compose -f docker-compose.yml build --no-cache

# Start in production mode
docker-compose up -d
```

### Optimize Laravel

```bash
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
docker-compose exec app composer install --optimize-autoloader --no-dev
```

## 📊 Monitoring

### View Container Stats

```bash
docker stats
```

### View Container Health

```bash
docker-compose ps
```

### Inspect Container

```bash
docker inspect rescuenet_app
```

## 🐛 Troubleshooting

### Container won't start

```bash
# Check logs
docker-compose logs app

# Rebuild containers
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

### Permission errors

```bash
# Fix permissions
docker-compose exec app chown -R www-data:www-data /var/www/html
docker-compose exec app chmod -R 775 /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/bootstrap/cache
```

### Database connection issues

```bash
# Check if database is running
docker-compose ps db

# Check database logs
docker-compose logs db

# Test connection
docker-compose exec app php artisan migrate:status
```

### Clear all caches

```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

## 🔒 Security Notes

1. **Change default passwords** in `.env` before deployment
2. **Set `APP_DEBUG=false`** in production
3. **Use strong `APP_KEY`**
4. **Restrict database ports** in production
5. **Enable HTTPS** with SSL certificates
6. **Regular security updates** for Docker images

## 📝 Environment Variables

Key environment variables in `.env`:

```env
APP_NAME=RescueNet
APP_ENV=production
APP_DEBUG=false
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=rescuenet
DB_USERNAME=rescuenet
DB_PASSWORD=rescuenet

REDIS_HOST=redis
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
```

## 🔄 Backup & Restore

### Backup

```bash
# Backup database
docker-compose exec db mysqldump -u rescuenet_user -p rescuenet > backup_$(date +%Y%m%d).sql

# Backup storage
tar -czf storage_backup_$(date +%Y%m%d).tar.gz storage/
```

### Restore

```bash
# Restore database
docker-compose exec -T db mysql -u rescuenet_user -p rescuenet < backup.sql

# Restore storage
tar -xzf storage_backup.tar.gz
```

## 📚 Additional Resources

-   [Docker Documentation](https://docs.docker.com/)
-   [Docker Compose Documentation](https://docs.docker.com/compose/)
-   [Laravel Documentation](https://laravel.com/docs)

## 🆘 Support

For issues or questions, please refer to the main project documentation or open an issue in the repository.
