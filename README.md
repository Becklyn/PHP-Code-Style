PHP Code Style Checker
======================


Installation
------------

```bash
composer require --dev becklyn/php-cs 
```

Now run your tools like this:


Usage
-----

### PHPStan

```bash
php vendor/bin/phpstan analyse -l 4 --memory-limit 4G -c vendor/becklyn/php-cs/phpstan.neon .
```


### PHP CS Fixer

```bash
php vendor/bin/php-cs-fixer fix --dry-run --diff
```


Complete Gitlab Test Script
---------------------------

Just add the file `.gitlab-ci.yml` in the root of your project:

```yaml
kaba:
    script:
        - yarn
        - composer install --no-interaction
        - 'npx kaba --analyze'

php_cs_fixer:
    script:
        - 'php vendor/bin/php-cs-fixer fix --dry-run --diff --config vendor/becklyn/php-cs/.php_cs.dist'

phpstan:
    script:
        - 'php vendor/bin/phpstan analyse -l 4 --memory-limit 4G -c vendor/becklyn/php-cs/phpstan.neon .'
```
