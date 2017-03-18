composer.phar:
	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	php composer-setup.php
	php -r "unlink('composer-setup.php');"

.PHONY: install
install: composer.phar
	./composer.phar install --no-dev --prefer-dist --optimize-autoloader --no-interaction
