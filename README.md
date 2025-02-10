requirements
composer v2.7.6
node js v18.20
php v8 ^
mysql database

steps
- clone repo
- open terminal inside repo
- run this commands
- composer install
- npm install
- make filename .env and copy paste this ( see below )
After copy pasting run this
- php artisan migrate:fresh --seed
- php artisan key:gen
- php artisan passport:install
- php artisan serve ( cmd terminal 1 )
- npm run dev ( cmd terminal 2)

APP_NAME="Almar Freemile Financing Corporation"
APP_ENV=local
APP_KEY=base64:1mP+JzPtvoM477MbDGG7dwElSsP723/PoxJAfm328jI=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=almar
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=pusher
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=database
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=6a7e1d011b02e2
MAIL_PASSWORD=b61a372427b8f7
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="reminder@almarfinancecorpuration.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=1675225
PUSHER_APP_KEY=15eaa345d50c1f6f3c7b
PUSHER_APP_SECRET=d02c8d5a224810dc106d
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=ap3

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
