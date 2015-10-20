# Review Engine based on Laravel


## Installation

```sh
git clone https://github.com/HTW-Webtech/ReviewEngine
cd ReviewEngine

cp .env.example .env

# configure the environment settings
vim .env

# configure the database settings (again)
vim config/app.php

# fill the database
php artisan migrate
```


## Troubleshooting

### Using MAMP?

Add `'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock',` to the `mysql` connection configuration in `config/database.php`