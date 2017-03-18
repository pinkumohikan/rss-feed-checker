composer.phar:
	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	php composer-setup.php
	php -r "unlink('composer-setup.php');"

config/general.yaml:
	cp config/general.yaml.template config/general.yaml

.PHONY: install
install: composer.phar config/general.yaml
	./composer.phar install --no-dev --prefer-dist --optimize-autoloader --no-interaction
