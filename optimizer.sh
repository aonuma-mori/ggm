#!/bin/bash

# 1. git pull origin master
# 2. php composer.phar update
# 3. rm -f var/cache/dev/* && rm -f var/cache/prod/*

# ENV:
while read line
do
  # echo $line
  if [[ ${line} =~ ^APP_ENV ]]; then
    # echo ${line}
    ENVTMP=(${line//=/ })
    ENV=${ENVTMP[1]}
    echo "APP_ENV: "${ENV}
  fi
done < ./.env

# Git pull:
git pull origin master;

# composer update
if [ $ENV = "prod" ];  then
/usr/local/php7.1/bin/php composer.phar update
else
php composer.phar update
fi

# Delete cache:
rm -f var/cache/dev/*
rm -f var/cache/prod/*

exit