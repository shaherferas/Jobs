# Job Management API

## Task Description

You need to design and implement an API for managing job entries using PHP. The API should support two types of users: regular users and managers. Regular users can create, view, and update only their own jobs, while managers can view all jobs. When a new job is created, managers should be notified asynchronously.

## Features

1. **API Endpoints**:
    - **Register**: Allows to create a regular user accounts.
    - **Login**: Allows to log into the system and returns the Bearer token and user data.
    - **Logout**: Allows to log out.
    - **CreateJobEndpoint**: Allows users to create a new job.
    - **ListJobsEndpoint**: Allows users to list jobs.

2. **Notification System**:
    - Notifies managers asynchronously when a new job is created using RabbitMQ.

3. **Docker**:
    - Local environment setup with a MySQL database.

4. **Unit Tests**:
    - Tests for the API endpoints: `CreateJobTest` and `ListJobsTest`.

5. **Authentication**:
    - Sanctum for API authentication.

6. **API Documentation**:
    - Laravel Swagger for API documentation.

## Setup Instructions

### Prerequisites

- Docker
- Docker Compose
- PHP
- Composer

### Step-by-Step Setup

1. **Clone the Repository**:

   ```bash
   git clone https://github.com/your-repo/job-management-api.git
   cd job-management-api
   
2. **Install Dependencies**:
   ```bash
   composer install

3. **Environment Configuration: Copy the .env.example file to .env and update the necessary environment variables**:
   ```bash 
    cp .env.example .env
   
- Ensure the following variables are set for Docker MySQL:
   ```bash
        DB_CONNECTION=mysql
        DB_HOST=host.docker.internal
        DB_PORT=3306
        DB_DATABASE='jobs'
        DB_USERNAME='root'
        DB_PASSWORD='root'
  ```

4. **Docker Setup: Build and run the Docker containers**:
   ```bash
    docker-compose up --build

5. **Run Migrations: Run the database migrations/seeders inside the Docker container**:
   ```bash
   docker-compose exec app php artisan migrate
   docker-compose exec app php artisan db:seed UserSeeder
   
6. **Generating Swagger API Documentation**:
   ```bash
   php artisan l5-swagger:generate

## Custom Requests and Services
- Custom Requests: Added to controllers for validation.
- Services: **JobService** and **UserService** for business logic.

## Authentication
- **Sanctum**: Used for API authentication.

## Deliverables
1. Code for the API endpoints and notification system.
2. Docker configuration files (**Dockerfile** and **docker-compose.yml**).
3. Unit tests for the API endpoints.
4. This README file with setup instructions and a brief explanation of the approach.

# Conclusion
This project implements a job management API with user roles, asynchronous notifications, and a Dockerized environment. It includes unit tests and API documentation for easy integration and testing.
