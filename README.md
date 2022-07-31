    # Slim Framework 4 Skeleton Application
#### Install the Application
```bash
cd [my-app-name]
composer start
```
After that, open `http://localhost:8000` in your browser.

---

Run this command in the application directory to run the test suite

```bash
composer test
```

---
#### Database Configuration

You can find database configuration in `app/settings.php`. Here you can edit doctrine section:
```php 
'doctrine' => [
    'dev_mode' => true,
    'cache_dir' => APP_ROOT . '/var/doctrine',
    'metadata_dirs' => [APP_ROOT . '/src/Domain/Entity'],
    'connection' => [
        'driver' => 'pdo_mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'dbname' => 'database_name',
        'user' => 'username',
        'password' => 'password',
    ]
]
```
