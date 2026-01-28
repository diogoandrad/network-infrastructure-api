# Network & Device API

This project is a **Laravel 12 REST API** for managing **Networks** and **Devices**, designed with **Clean Architecture principles** (Domain, Application, Infrastructure) and a clear separation of concerns.

The goal is to demonstrate good software design, testability, and maintainability rather than UI concerns.

---

## ✨ Features

* CRUD operations for **Networks**
* CRUD operations for **Devices**
* Clean Architecture (Domain / Application / Infrastructure)
* Repository pattern with interfaces
* Form Request validation
* Feature tests using PHPUnit
* Database factories and migrations
* Fully containerized with **Docker & Docker Compose**
* **High-performance runtime using Laravel Octane with Swoole**
* Optional integration with **Shodan** for device enrichment (async job)

---

## 🏗️ Architecture Overview

The project follows a layered and componentized structure:

```
app/
├── Application/        # Use cases (business actions)
├── Domain/             # Entities and repository interfaces
├── Infrastructure/     # Eloquent repository implementations
├── Http/               # Controllers and request validation
├── Models/             # Eloquent models
├── Jobs/               # Background jobs
├── Services/           # Domain-related services
├── Integrations/       # External integrations (e.g. Shodan)
└── Providers/          # Service bindings and bootstrapping
```

### Octane & Swoole Runtime

This application runs on **Laravel Octane** with **Swoole**, enabling:

* Long-lived application instances
* Faster request handling
* Reduced bootstrap overhead
* Improved performance under high concurrency

Octane is enabled inside the Docker environment and replaces the traditional PHP-FPM lifecycle.

### Design Decisions

* **Use Cases** encapsulate business logic (e.g. `CreateNetworkUseCase`).
* **Controllers** are thin and only coordinate requests and responses.
* **Repositories** are injected via interfaces to keep the domain independent of Eloquent.
* **Entities** represent core business objects, independent of the database.
* **Async jobs** are used for external API enrichment (Shodan).

---

## 🚀 Setup Instructions

### Requirements

* PHP >= 8.3
* Composer
* PostgreSQL
* Docker & Docker Compose

### Installation

```bash
git clone https://github.com/diogoandrad/network-infrastructure-api.git
cd project
composer install
```

### Environment Configuration

Copy the example environment file:

```bash
cp .env.example .env
php artisan key:generate
```

The project is configured to use **PostgreSQL**, running inside Docker containers.

### Docker Setup

The entire application stack can be started with a **single command**. Docker Compose will provision and run all required components (application, database, and network configuration).

```bash
docker compose up -d --build
```

After this command completes, the project will be fully up and running.

Run migrations:

```bash
docker compose exec app php artisan migrate
```

````

(Optional) Seed sample data:

```bash
php artisan db:seed
````

---

## ▶️ Running the Application

### Using Laravel Octane (Swoole)

Start the application using Octane inside Docker:

```bash
docker compose exec app php artisan octane:start --server=swoole --host=0.0.0.0 --port=8000
```

The API will be available at:

```
http://127.0.0.1:8000
```

> ℹ️ Note: Since Octane uses long-lived workers, any changes to configuration or service providers require restarting Octane.

---

## 🔌 API Design and Documentation

The API follows RESTful design principles with clear resource-oriented endpoints, consistent HTTP verbs, and predictable response structures.

Interactive API documentation is available directly in the browser:

```
/api/documentation
```

This documentation provides:

* A complete list of available endpoints
* Request and response examples
* Validation rules and expected payloads
* HTTP status codes and error formats

The documentation is intended to simplify exploration, testing, and integration for both frontend and backend consumers.

---

## 🔌 API Endpoints (Summary)

### Networks

* `GET /api/networks`
* `GET /api/networks/{id}`
* `POST /api/networks`
* `PUT /api/networks/{id}`
* `DELETE /api/networks/{id}`

### Devices

* `GET /api/devices`
* `GET /api/devices/{id}`
* `POST /api/devices`
* `PUT /api/devices/{id}`
* `DELETE /api/devices/{id}`

Validation rules are handled via **Form Request** classes.

---

## 🧪 Testing

The project includes **feature tests** for the Network API and is fully compatible with Docker.

### Run Tests Using Docker

```bash
docker compose exec app php artisan test
```

or

```bash
docker compose exec app vendor/bin/phpunit
```

---

## 🧠 Assumptions

* Authentication and authorization are **out of scope** for this project.
* The API is intended as a backend service, not a full production system.
* PostgreSQL is used to reflect a real-world production setup.
* The application is fully **containerized and componentized** using Docker.
* Laravel **Octane with Swoole** is used to demonstrate high-performance runtime capabilities.
* External integrations (e.g. Shodan) are optional and can be mocked or disabled.

---

## 🔒 Security Considerations

* Input validation is enforced via Laravel Form Requests.
* Mass assignment protection is enabled on Eloquent models.
* No sensitive credentials are stored in the repository.

---

## 📄 License

This project is provided for evaluation and demonstration purposes.
