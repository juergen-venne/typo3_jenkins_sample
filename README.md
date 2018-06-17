# TYPO3 9 Sample

### Requirements

1. docker and docker-compose

### Project startup

```bash
# Set port bindings for docker
cp docker-compose.override.sample.yml docker-compose.override.yml

# Run build container to install dependencies and build project
docker-compose -f docker-compose.build.yml build
docker-compose -f docker-compose.build.yml run build

# Start containers
docker-compose up --build -d

# Follow logs
docker-compose logs -f
```

### Reset

Kill all containers (looses all persistency, but mounted volumes)
```bash
# Down all running containers
docker-compose down -v
docker-compose -f docker-compose.build.yml down -v

# Rebuild docker images
docker-compose build
docker-compose -f docker-compose.build.yml build

# Rebuild project
docker-compose -f docker-compose.build.yml run build

# Restart containers (webserver, solr, redis, …)
docker-compose up -d
```