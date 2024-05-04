#!/bin/bash

#user="www"

cd ../../../..

# 执行有问题
#wget https://mirrors.aliyun.com/composer/composer.phar -O /usr/local/bin/composer
#chmod a+x /usr/local/bin/composer
#composer u -o -vvv --no-dev

#composer install --ignore-platform-req=ext-sodium --ignore-platform-req=ext-pcntl --ignore-platform-req=ext-posix --ignore-platform-req=ext-zip
#if [ $? -ne 0 ]; then
#  	echo "Error: composer install."
#  	exit 1
#fi

if [ ! -f ./.env ]; then
#    echo ".env file is not found, create .env"
    cp ./.env.example_panel ./.env

    php artisan key:generate

#    composer update --ignore-platform-req=ext-sodium --ignore-platform-req=ext-pcntl --ignore-platform-req=ext-posix --ignore-platform-req=ext-zip
#    if [ $? -ne 0 ]; then
#      	echo "Error: composer update."
#      	exit 1
#    fi

    echo '' >> ./.env
else
    echo "Error: 已经安装过了."
	  exit 1
fi

# 设置目录权限
chown -R www:www ./bootstrap/cache
chown -R www:www ./storage

# 安装前端依赖 生产环境安装系统不用，开发环境手动安装，用于合并js、css
#npm install
#if [ $? -ne 0 ]; then
#    echo "Error: npm install."
#    exit 1
#fi

# 合并js、css 安装时不合并
#npm run prod-combine
#if [ $? -ne 0 ]; then
#    echo "Error: npm run prod-combine."
#    exit 1
#fi

# 生成前端静态文件软链接
php artisan storage:link
if [ $? -ne 0 ]; then
    echo "Error: php artisan storage:link."
    exit 1
fi

#php artisan optimize

echo "系统安装完成！"
exit 0