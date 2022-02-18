# wakfu



sudo apt update
sudo apt upgrade

sudo apt install  ca-certificates apt-transport-https software-properties-common

sudo add-apt-repository ppa:ondrej/php

sudo apt update
sudo apt install php8.0 libapache2-mod-php8.0  php8.0-gd php8.0-xml php8.0-mcrypt php8.0-mysql

echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | sudo tee /etc/apt/sources.list.d/symfony-cli.list
sudo apt update
sudo apt install symfony-cli

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
composer install