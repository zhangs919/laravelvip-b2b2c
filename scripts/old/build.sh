#!/bin/bash

case $1 in
    local)
        echo 'build local'
        source ./config_local.sh
        ;;
    staging)
        echo 'build staging'
        source ./config_staging.sh
        ;;
    production)
        echo 'build production'
        source ./config_production.sh
        ;;
    *)
        echo 'usage ./build.sh local|staging|production'
        exit 1
        ;;
esac

cd ..
composer install --ignore-platform-req=ext-sodium --ignore-platform-req=ext-pcntl --ignore-platform-req=ext-posix --ignore-platform-req=ext-mongodb --ignore-platform-req=ext-zip
if [ $? -ne 0 ]; then
  	echo "Error: composer install."
  	exit 1
fi

if [ ! -f ./.env ]; then
    echo ".env file is not found, create .env"
    cp ./.env.example ./.env

    php artisan key:generate

    composer update --ignore-platform-req=ext-sodium --ignore-platform-req=ext-pcntl --ignore-platform-req=ext-posix --ignore-platform-req=ext-mongodb --ignore-platform-req=ext-zip
    if [ $? -ne 0 ]; then
      	echo "Error: composer update."
      	exit 1
    fi

    sed -i -e "s/APP_ENV=.*/APP_ENV=$APP_ENV/" ./.env
    sed -i -e "s/APP_DEBUG=.*/APP_DEBUG=$APP_DEBUG/" ./.env

    sed -i -e "s/DB_DATABASE=.*/DB_DATABASE=$DB/" ./.env
    sed -i -e "s/DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" ./.env
    sed -i -e "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" ./.env

    sed -i -e "s/SESSION_DOMAIN=.*/SESSION_DOMAIN=$SESSION_DOMAIN/" ./.env
    sed -i -e "s/ROOT_DOMAIN=.*/ROOT_DOMAIN=$ROOT_DOMAIN/" ./.env
    sed -i -e "s/BACKEND_DOMAIN=.*/BACKEND_DOMAIN=$BACKEND_DOMAIN/" ./.env
    sed -i -e "s/SELLER_DOMAIN=.*/SELLER_DOMAIN=$SELLER_DOMAIN/" ./.env
    sed -i -e "s/STORE_DOMAIN=.*/STORE_DOMAIN=$STORE_DOMAIN/" ./.env
    sed -i -e "s/FRONTEND_DOMAIN=.*/FRONTEND_DOMAIN=$FRONTEND_DOMAIN/" ./.env
    sed -i -e "s/MOBILE_DOMAIN=.*/MOBILE_DOMAIN=$MOBILE_DOMAIN/" ./.env
    sed -i -e "s/KF_DOMAIN=.*/KF_DOMAIN=$KF_DOMAIN/" ./.env
    sed -i -e "s/GOODS_DETAIL_DOMAIN=.*/GOODS_DETAIL_DOMAIN=$GOODS_DETAIL_DOMAIN/" ./.env
    sed -i -e "s/MOBILE_GOODS_DETAIL_DOMAIN=.*/MOBILE_GOODS_DETAIL_DOMAIN=$MOBILE_GOODS_DETAIL_DOMAIN/" ./.env
    sed -i -e "s/PUSH_DOMAIN=.*/PUSH_DOMAIN=$PUSH_DOMAIN/" ./.env

    sed -i -e "s/API_DOMAIN=.*/API_DOMAIN=$API_DOMAIN/" ./.env
	sed -i -e "s/DEBUGBAR_ENABLED=.*/DEBUGBAR_ENABLED=$DEBUGBAR_ENABLED/" ./.env

	# TODO 以下两个配置 后期修改为，从后台配置读取，不在文件中配置
    sed -i -e "s/ALI_ACCESS_KEY_ID=.*/ALI_ACCESS_KEY_ID=$ALI_ACCESS_KEY_ID/" ./.env
    sed -i -e "s/ALI_ACCESS_KEY_SECRET=.*/ALI_ACCESS_KEY_SECRET=$ALI_ACCESS_KEY_SECRET/" ./.env


    echo '' >> ./.env

    php artisan migrate
    if [ $? -ne 0 ]; then
	  	echo "Error: php artisan migrate."
	  	exit 1
	fi

    # 执行脚本写入初始数据
    php artisan db:seed --class=DatabaseSeeder
    if [ $? -ne 0 ]; then
		echo "Error: php artisan db:seed --class=DatabaseSeeder."
		exit 1
	fi
else
    php artisan migrate
    if [ $? -ne 0 ]; then
		echo "Error: php artisan migrate."
		exit 1
	fi
fi

# 导入后台权限菜单sql
#mysql -u$DB_USERNAME -p$DB_PASSWORD $DB < ./data/backend.sql

# 安装前端依赖
yarn install
if [ $? -ne 0 ]; then
	echo "Error: yarn install."
	exit 1
fi

# 合并js、css
yarn run prod-combine
if [ $? -ne 0 ]; then
	echo "Error: yarn run prod-combine."
	exit 1
fi

# 生成前端静态文件软链接
php artisan storage:link
if [ $? -ne 0 ]; then
	echo "Error: php artisan storage:link."
	exit 1
fi



## todo 以下命令还有待调试
# 类映射加载优化(生产环境执行)
#php artisan optimize --force # 生成缓存
#php artisan clear-compiled # 清除缓存

# todo 配置  supervisor 参考 docs/supervisor.md进行配置即可

# 重启 supervisor
#supervisorctl reload
#if [ $? -ne 0 ]; then
#	echo "Error: supervisorctl reload."
#	exit 1
#fi

