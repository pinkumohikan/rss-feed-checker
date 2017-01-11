composer.phar:
	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	php composer-setup.php
	php -r "unlink('composer-setup.php');"

.env:
	cp .env.example .env

.PHONY: install
install: .env composer.phar
	./composer.phar install --prefer-dist --optimize-autoloader --no-interaction
