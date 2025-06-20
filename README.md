<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://ikn.go.id/storage/ikn-nusantara-auliaakbar-05.png" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Piper Photobooth

Piper Photobooth is a modern web application designed to streamline the management and operation of Photobooth within the Ibu Kota Nusantara (IKN) development. Leveraging cutting-edge technologies, the platform provides a comprehensive suite of tools for building automation, energy management, security, and occupant comfort.


- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- **PHP >= 8.1** and **Composer**
- **Node.js >= 14.0** and **npm**
- **MySQL/MariaDB** or **PostgreSQL** database
- [Laravel](https://laravel.com/docs) installed on your local machine

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/smart-building-ikn.git
   cd smart-building-ikn

2. Install dependencies:
    ```bash
    composer install
    npm install

3. Set up your environment variables:
    ```bash
    cp .env.example .env
    php artisan key:generate

4. Configure your database in the .env file and run migrations:
    ```bash
    php artisan migrate

5. Run the development server
    ```bash
    php artisan serve
    npm run dev

## Installation Websocket?

1. Publish Vendor BeyondCode
    ```bash
    php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"
    php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"


2. Add Environment on .env
    ```bash
    PUSHER_APP_ID=local
    PUSHER_APP_KEY=local
    PUSHER_APP_SECRET=local
    PUSHER_HOST=6001
    PUSHER_PORT=443
    PUSHER_SCHEME=http
    PUSHER_APP_CLUSTER=mt1

3. Run the development server websocket
    ```bash
    php artisan serve
    php artisan websockets:serve

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Exenesia](http://exenesia.com)**
- **[Dimdevs](https://www.instagram.com/dimdevs_)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
