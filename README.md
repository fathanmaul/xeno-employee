## Installation

Follow these steps to install this project:

1. **Clone this Repository** :

```bash
git clone https://github.com/fathanmaul/xeno-employee.git
cd xeno-employee
```

2. **Install PHP Depedencies**

```bash
composer install
```

3. **Copy .env file**

```bash
cp .env.example .env
```

4. **Generate Application Key**

```bash
php artisan key:generate
```

5. **Configure Database**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xeno_employee
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run Migrations & Seeders**
```bash
php artisan migrate --seed
```

7. **Serve the Application**
```bash
php artisan serve
```
