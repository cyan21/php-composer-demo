# PHP demo

composer package which makes a call to the Artifactory API to get license info


## Requirements

install nginx, PHP-fmp, php, php-xml (for phpUnit)

### Manually

On Centos7
```
$ yum install -y nginx php fmp-php php-xml
```

install Composer

```
$ curl -sS https://getcomposer.org/installer | php
$ chmod +x composer.phar
$ mv composer.phar /usr/local/bin/composer
$ composer -V
```

Configuration for PHP

```
/etc/php.ini => cgi.fix_pathinfo=0
/etc/php-fpm.d/www.conf ==> listen
/etc/nginx/conf.d/default.conf
disable SELINUX 
systemctl restart nginx php-fpm
```

### with Docker 

```
docker pull composer
docker run --rm -ti  --volume <PATH_TO_CLONED_GITHUB_REPO>:/app  composer /bin/bash
```


## Composer configuration 

Edit the following files 

* Artifactory_config/auth.json 

```
    "http-basic": {
        "<ART_HOST>:<ART_PORT>": {
            "username": "<USER>",
            "password": "<PASS>"
        }
```

* Artifactory_config/config.json 
```
    "repositories": [
        {
            "type": "composer",
            "url": "http://<ART_HOST>:<ART_PORT>/artifactory/api/composer/<REMOTE_REPO>"
        },
	{
        "packagist.org": false
	}
```

Copy them to $COMPOSER_HOME

```
cp Artifactory_config/* $COMPOSER_HOME/
```


## How to 

test composer package

```
$ mkdir php-demo
$ git clone https://github.com/cyan21/php-composer-demo.git
$ cd php-demo
$ composer install
$ vendor/bin/phpunit
```

> to redownload packages from scratch, make sure:
>  - vendor folder is empty
>  - composer cache is deleted (cf. composer clear-cache command)
>  - delete the composer.lock


create tarball 

```
tar -czvf artyInfo.tar.gz composer.json composer.lock README.md src tests
```


deploy to artifactory

```
curl -H 'X-JFrog-Art-Api: <API_KEY>' <ARTIFACTORY_HOST>/<PHP_REPO> -T artyInfo.tar.gz

```

Example 

```
curl -H 'X-JFrog-Art-Api: AKCp2WXXJ5gyi72WFnDgsCu8SAno112Gwbmg1rAd3UqMxA3GNpBFTRRw4hteo1nSnnXURajae' http://192.168.41.41:8081/artifactory/php-local/ -T /usr/share/nginx/html/myapp/vendor/Ych/artyInfo.tar.gz
```
