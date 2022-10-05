<?php return array (
  'app' => 
  array (
    'name' => 'chateraise',
    'env' => 'develop',
    'debug' => false,
    'url' => 'http://localhost',
    'asset_url' => NULL,
    'timezone' => 'Asia/Tokyo',
    'locale' => 'ja',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:CfVjDFpXsIP98W557cBwFQ7gzm1qJ4z7xUL/WJhDWjI=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Kyslik\\ColumnSortable\\ColumnSortableServiceProvider',
      23 => 'Kreait\\Laravel\\Firebase\\ServiceProvider',
      24 => 'App\\Providers\\AppServiceProvider',
      25 => 'App\\Providers\\AuthServiceProvider',
      26 => 'App\\Providers\\EventServiceProvider',
      27 => 'App\\Providers\\RouteServiceProvider',
      28 => 'Barryvdh\\Debugbar\\ServiceProvider',
      29 => 'Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider',
      30 => 'Collective\\Html\\HtmlServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Debugbar' => 'Barryvdh\\Debugbar\\Facade',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'CustomConst' => 'App\\Consts\\CustomConst',
      'MyFunc' => 'App\\Libraries\\MyFunc',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'user',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'user' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
      'admin' => 
      array (
        'driver' => 'session',
        'provider' => 'admins',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
      'admins' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\Admin',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
      'admins' => 
      array (
        'provider' => 'admins',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'cluster' => NULL,
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/var/www/html/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => 'AKIATREDYGSDMK5OFQFH',
        'secret' => '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',
        'region' => 'ap-northeast-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'chateraise_cache',
  ),
  'columnsortable' => 
  array (
    'columns' => 
    array (
      'alpha' => 
      array (
        'rows' => 
        array (
          0 => 'description',
          1 => 'email',
          2 => 'name',
          3 => 'slug',
        ),
        'class' => 'fa fa-sort-alpha',
      ),
      'amount' => 
      array (
        'rows' => 
        array (
          0 => 'amount',
          1 => 'price',
        ),
        'class' => 'fa fa-sort-amount',
      ),
      'numeric' => 
      array (
        'rows' => 
        array (
          0 => 'created_at',
          1 => 'updated_at',
          2 => 'level',
          3 => 'id',
          4 => 'phone_number',
        ),
        'class' => 'fa fa-sort-numeric',
      ),
    ),
    'enable_icons' => true,
    'default_icon_set' => 'fa fa-sort',
    'sortable_icon' => 'fa fa-sort',
    'clickable_icon' => false,
    'icon_text_separator' => ' ',
    'asc_suffix' => '-up',
    'desc_suffix' => '-down',
    'anchor_class' => NULL,
    'active_anchor_class' => NULL,
    'direction_anchor_class_prefix' => NULL,
    'uri_relation_column_separator' => '.',
    'formatting_function' => 'ucfirst',
    'format_custom_titles' => true,
    'inject_title_as' => NULL,
    'allow_request_modification' => true,
    'default_direction' => 'asc',
    'default_direction_unsorted' => 'desc',
    'default_first_column' => false,
    'join_type' => 'leftJoin',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'chateraise',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'chateraise',
        'username' => 'root',
        'password' => 'password',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'chateraise',
        'username' => 'root',
        'password' => 'password',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'chateraise',
        'username' => 'root',
        'password' => 'password',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'options' => 
      array (
        'cluster' => 'predis',
        'prefix' => 'chateraise_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'public',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => 'AKIATREDYGSDMK5OFQFH',
        'secret' => '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',
        'region' => 'ap-northeast-1',
        'bucket' => 'chateraise',
      ),
    ),
  ),
  'firebase' => 
  array (
    'credentials' => 
    array (
      'file' => '/var/www/html/config/json/firebase.json',
    ),
    'database' => 
    array (
      'url' => 'https://chateraisedev.page.link',
    ),
    'dynamic_links' => 
    array (
      'default_domain' => 'https://chateraisedev.page.link',
    ),
    'storage' => 
    array (
      'default_bucket' => 'chateraise-dev.appspot.com',
    ),
    'cache_store' => 'file',
    'logging' => 
    array (
      'http_log_channel' => NULL,
      'http_debug_log_channel' => NULL,
    ),
    'debug' => false,
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/var/www/html/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/var/www/html/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
        'permission' => 436,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => '587',
    'from' => 
    array (
      'address' => 'n.yokomakura@soushin-lab.co.jp',
      'name' => 'chateraise',
    ),
    'encryption' => 'tls',
    'username' => 'n.yokomakura@soushin-lab.co.jp',
    'password' => 'iFE5l6TrC9xraGV1KwU4H2bJYa66cU3Z0SH6kH7Ovdskn6D0tawYjX1XD9bEj1Um60g8GABWOP1sb3twChLpDQbiGQ7d7BxFUvVU',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/var/www/html/resources/views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'mobile' => 
  array (
    'env' => 'production',
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'AKIATREDYGSDMK5OFQFH',
        'secret' => 'DdN6K9Bf7xR/JHAJJXdlGBzAW8Ux7ffwYuTYhGbo',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'ap-northeast-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => 'AKIATREDYGSDMK5OFQFH',
      'secret' => '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',
      'region' => 'ap-northeast-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/var/www/html/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'chateraise_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'tabledata' => 
  array (
    'member' => 
    array (
      0 => 
      array (
        'name' => '管理者ID',
        'class' => '',
        'data' => '',
      ),
      1 => 
      array (
        'name' => '氏名',
        'class' => '',
        'data' => '',
      ),
      2 => 
      array (
        'name' => '部署',
        'class' => '',
        'data' => '',
      ),
      3 => 
      array (
        'name' => '役職',
        'class' => '',
        'data' => '',
      ),
      4 => 
      array (
        'name' => 'メールアドレス',
        'class' => '',
        'data' => '',
      ),
      5 => 
      array (
        'name' => '登録日',
        'class' => '',
        'data' => '',
      ),
    ),
    'user' => 
    array (
      0 => 
      array (
        'name' => '顧客ID',
        'class' => '',
        'data' => '',
      ),
      1 => 
      array (
        'name' => 'ニックネーム',
        'class' => '',
        'data' => '',
      ),
      2 => 
      array (
        'name' => '生年月日',
        'class' => '',
        'data' => '',
      ),
      3 => 
      array (
        'name' => 'メールアドレス',
        'class' => '',
        'data' => '',
      ),
      4 => 
      array (
        'name' => 'お気に入り登録数',
        'class' => '',
        'data' => '',
      ),
      5 => 
      array (
        'name' => '登録日',
        'class' => '',
        'data' => '',
      ),
      6 => 
      array (
        'name' => '最終ログイン',
        'class' => '',
        'data' => '',
      ),
    ),
    'information' => 
    array (
      0 => 
      array (
        'name' => 'タイトル',
        'class' => '',
        'data' => '',
      ),
      1 => 
      array (
        'name' => 'カテゴリ',
        'class' => '',
        'data' => '',
      ),
      2 => 
      array (
        'name' => '投稿日時',
        'class' => '',
        'data' => '',
      ),
      3 => 
      array (
        'name' => '表示/非表示',
        'class' => '',
        'data' => '',
      ),
    ),
    'coupon' => 
    array (
      0 => 
      array (
        'name' => 'クーポンID',
        'class' => '',
        'data' => '',
      ),
      1 => 
      array (
        'name' => '画像',
        'class' => '',
        'data' => '',
      ),
      2 => 
      array (
        'name' => 'クーポン名',
        'class' => '',
        'data' => '',
      ),
      3 => 
      array (
        'name' => 'ステータス',
        'class' => '',
        'data' => '',
      ),
      4 => 
      array (
        'name' => '公開日',
        'class' => '',
        'data' => '',
      ),
      5 => 
      array (
        'name' => '利用期限',
        'class' => '',
        'data' => '',
      ),
    ),
    'store' => 
    array (
      0 => 
      array (
        'name' => '店舗ID',
        'class' => '',
        'data' => '',
      ),
      1 => 
      array (
        'name' => '登録日時',
        'class' => '',
        'data' => '',
      ),
      2 => 
      array (
        'name' => '店舗名',
        'class' => '',
        'data' => '',
      ),
      3 => 
      array (
        'name' => '電話番号',
        'class' => '',
        'data' => '',
      ),
      4 => 
      array (
        'name' => '住所',
        'class' => '',
        'data' => '',
      ),
      5 => 
      array (
        'name' => 'ステータス',
        'class' => '',
        'data' => '',
      ),
    ),
    'products' => 
    array (
      0 => 
      array (
        'name' => '商品ID',
        'class' => '',
        'data' => '',
      ),
      1 => 
      array (
        'name' => '画像',
        'class' => '',
        'data' => '',
      ),
      2 => 
      array (
        'name' => '商品名',
        'class' => '',
        'data' => '',
      ),
      3 => 
      array (
        'name' => 'カテゴリ',
        'class' => '',
        'data' => '',
      ),
      4 => 
      array (
        'name' => '価格 (＄)',
        'class' => '',
        'data' => '',
      ),
      5 => 
      array (
        'name' => 'ステータス',
        'class' => '',
        'data' => '',
      ),
      6 => 
      array (
        'name' => 'お気に入り登録数)',
        'class' => '',
        'data' => '',
      ),
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/var/www/html/resources/views',
    ),
    'compiled' => '/var/www/html/storage/framework/views',
  ),
  'debugbar' => 
  array (
    'enabled' => NULL,
    'except' => 
    array (
      0 => 'telescope*',
      1 => 'horizon*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => '/var/www/html/storage/debugbar',
      'connection' => NULL,
      'provider' => '',
    ),
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => false,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => false,
      'models' => true,
      'livewire' => true,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'backtrace_exclude_paths' => 
        array (
        ),
        'timeline' => false,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => false,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
    'theme' => 'auto',
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'ide-helper' => 
  array (
    'filename' => '_ide_helper',
    'format' => 'php',
    'meta_filename' => '.phpstorm.meta.php',
    'include_fluent' => false,
    'include_factory_builders' => false,
    'write_model_magic_where' => true,
    'write_model_relation_count_properties' => true,
    'write_eloquent_model_mixins' => false,
    'include_helpers' => false,
    'helper_files' => 
    array (
      0 => '/var/www/html/vendor/laravel/framework/src/Illuminate/Support/helpers.php',
    ),
    'model_locations' => 
    array (
      0 => 'app',
    ),
    'ignored_models' => 
    array (
    ),
    'extra' => 
    array (
      'Eloquent' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'Illuminate\\Database\\Query\\Builder',
      ),
      'Session' => 
      array (
        0 => 'Illuminate\\Session\\Store',
      ),
    ),
    'magic' => 
    array (
    ),
    'interfaces' => 
    array (
    ),
    'custom_db_types' => 
    array (
    ),
    'model_camel_case_properties' => false,
    'type_overrides' => 
    array (
      'integer' => 'int',
      'boolean' => 'bool',
    ),
    'include_class_docblocks' => false,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
