# update vendor libraries
composer update -n
# update DB schema
php bin/console doctrine:schema:update --force
# prepare public assets
npm install -g bower
php bin/console assets:install --symlink