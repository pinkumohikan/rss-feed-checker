.PHONY: setup test setup/dev
setup: composer.phar config/general.yaml
	./composer.phar install --no-dev --prefer-dist --optimize-autoloader --no-interaction

composer.phar:
	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	php composer-setup.php
	php -r "unlink('composer-setup.php');"

config/general.yaml:
	cp config/general.yaml.template config/general.yaml


test: vendor/bin/phpunit
	vendor/bin/phpunit -c tests/phpunit.xml --bootstrap bootstrap.php tests/

vendor/bin/phpunit:
	$(MAKE) setup/dev

setup/dev: composer.phar config/general.yaml
	./composer.phar install --dev --prefer-dist --optimize-autoloader --no-interaction
