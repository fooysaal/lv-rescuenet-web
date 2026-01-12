#!/bin/bash

# RescueNet Docker Setup Script

echo "🚀 Setting up RescueNet Docker Environment..."

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "❌ Docker is not installed. Please install Docker first."
    exit 1
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose is not installed. Please install Docker Compose first."
    exit 1
fi

# Copy environment file
if [ ! -f .env ]; then
    echo "📝 Creating .env file from .env.example..."
    cp .env.example .env

    # Update .env for Docker usage
    echo "🔧 Configuring .env for Docker..."
    sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env
    sed -i 's/# DB_HOST=db/DB_HOST=db/' .env
    sed -i 's/# DB_PORT=3306/DB_PORT=3306/' .env
    sed -i 's/# DB_DATABASE=rescuenet/DB_DATABASE=rescuenet/' .env
    sed -i 's/# DB_USERNAME=rescuenet/DB_USERNAME=rescuenet/' .env
    sed -i 's/# DB_PASSWORD=rescuenet/DB_PASSWORD=rescuenet/' .env
    sed -i 's/REDIS_HOST=127.0.0.1/REDIS_HOST=redis/' .env
    sed -i 's/# CACHE_STORE=redis/CACHE_STORE=redis/' .env

    echo "⚠️  Please review .env and update any additional configuration"
else
    echo "✅ .env file already exists"
fi

# Generate application key
echo "🔑 Generating application key..."
docker-compose run --rm app php artisan key:generate

# Build and start containers
echo "🏗️  Building Docker containers..."
docker-compose build

echo "🚀 Starting containers..."
docker-compose up -d

# Wait for database to be ready
echo "⏳ Waiting for database to be ready..."
sleep 10

# Run migrations
echo "📊 Running database migrations..."
docker-compose exec app php artisan migrate --force

# Create storage link
echo "🔗 Creating storage link..."
docker-compose exec app php artisan storage:link

# Set permissions
echo "🔒 Setting correct permissions..."
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chown -R www-data:www-data /var/www/html/bootstrap/cache
docker-compose exec app chmod -R 775 /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/bootstrap/cache

echo ""
echo "✅ Setup complete!"
echo ""
echo "📍 Your application is now running at:"
echo "   🌐 http://localhost:8080"
echo ""
echo "🔧 Useful commands:"
echo "   docker-compose ps              - View running containers"
echo "   docker-compose logs -f app     - View application logs"
echo "   docker-compose exec app bash   - Access app container"
echo "   docker-compose down            - Stop containers"
echo "   docker-compose down -v         - Stop and remove volumes"
echo ""
