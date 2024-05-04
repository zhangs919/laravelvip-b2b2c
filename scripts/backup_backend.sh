#!/bin/bash
user_name='shop'
password=''
database='shop'

if [ $1 ]; then
	user_name=$1
else
	echo "use default database user name $user_name"
fi

if [ $2 ]; then
	password=$2
else
	echo "use default database password $password"
fi

if [ $3 ]; then
	database=$3
else
	echo "use default database name $database"
fi

cat > ./data/backend.sql << EndOfTruncate
  truncate admin_menu;
  truncate admin_node;
  truncate admin_role;
  truncate system_config;
EndOfTruncate

mysqldump -u$user_name -p$password --no-create-db --no-create-info --skip-extended-insert $database --tables admin_menu admin_node admin_role system_config >> ./data/backend.sql

