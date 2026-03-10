#!/bin/bash
set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Header
echo -e "${BLUE}"
cat << "EOF"
╔════════════════════════════════════════════════════════════════╗
║                  🐳 FlareSpark Docker Setup                    ║
║                      Production Ready                          ║
╚════════════════════════════════════════════════════════════════╝
EOF
echo -e "${NC}"

# Function to print status
print_status() {
    echo -e "${GREEN}✓${NC} $1"
}

print_error() {
    echo -e "${RED}✗${NC} $1"
}

print_info() {
    echo -e "${BLUE}ℹ${NC} $1"
}

# Check if Docker is installed
print_info "Checking Docker installation..."
if ! command -v docker &> /dev/null; then
    print_error "Docker is not installed. Please install Docker Desktop first."
    exit 1
fi
print_status "Docker found: $(docker --version)"

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    print_error "Docker Compose is not installed."
    exit 1
fi
print_status "Docker Compose found: $(docker-compose --version)"

# Create .env file if it doesn't exist
print_info "Setting up environment variables..."
if [ ! -f .env ]; then
    cp .env.example .env
    print_status ".env file created from .env.example"
else
    print_status ".env file already exists"
fi

# Build Docker images
print_info "Building Docker images (this may take a few minutes)..."
echo ""
docker-compose build --no-cache
echo ""
print_status "Docker images built successfully"

# Start containers
print_info "Starting containers..."
echo ""
docker-compose up -d
echo ""
print_status "Containers started"

# Wait for services to be healthy
print_info "Waiting for services to be healthy..."
sleep 10

# Check if PostgreSQL is healthy
print_info "Verifying PostgreSQL connection..."
if docker-compose exec -T postgres pg_isready -U postgres > /dev/null 2>&1; then
    print_status "PostgreSQL is healthy"
else
    print_error "PostgreSQL health check failed"
fi

# Display useful information
echo ""
echo -e "${BLUE}════════════════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}✓ Setup Complete!${NC}"
echo -e "${BLUE}════════════════════════════════════════════════════════════════${NC}"
echo ""
echo -e "${YELLOW}📍 Access Your Application:${NC}"
echo "   Application:  http://localhost:8000"
echo "   Health Check: http://localhost:8000/health"
echo ""
echo -e "${YELLOW}📊 Database Details:${NC}"
echo "   Host:     localhost:5432"
echo "   Database: railway"
echo "   User:     postgres"
echo "   Password: secret"
echo ""
echo -e "${YELLOW}🛠️  Useful Commands:${NC}"
echo "   View logs:        docker-compose logs -f app"
echo "   Run artisan:      docker-compose exec app php artisan <command>"
echo "   Database shell:   docker-compose exec postgres psql -U postgres -d railway"
echo "   Stop containers:  docker-compose down"
echo "   Rebuild images:   docker-compose build --no-cache"
echo ""
echo -e "${YELLOW}📚 Documentation:${NC}"
echo "   Read DOCKER_SETUP.md for detailed guide"
echo ""
echo -e "${BLUE}════════════════════════════════════════════════════════════════${NC}"
echo ""

# Show deployment info
print_info "Ready for Railway deployment!"
echo "   1. Configure Railway environment variables in dashboard"
echo "   2. Run: railway up"
echo "   3. Check: railway logs"
echo ""
