#!/bin/bash

# 1. git pull origin master
# 2. php composer.phar update
# 3. rm -f var/cache/dev/* && rm -f var/cache/prod/*

# get ENV:
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
git add -A;
git commit -m "auto commit: "`date "+%Y%m%d_%H%M%S"`;

# All backup
if [ ! -e ./var/tmp/backup ]; then
mkdir -m 777 ./var/tmp/backup
fi
# - source rsync
# /Users/osamuyamakami/Documents/mywork/docker/ggm
echo "source copy....";
rsync -av --delete --exclude 'var/tmp/backup' --exclude '.git' /Users/osamuyamakami/Documents/mywork/docker/ggm ./var/tmp/backup/ggm_`date "+%Y%m%d"`
tar -pcvzf ./var/tmp/backup/ggm_`date "+%Y%m%d"`.tar.gz ./var/tmp/backup/ggm_`date "+%Y%m%d"`
rm -fR ./var/tmp/backup/ggm_`date "+%Y%m%d"`
echo "source copyed !";
# - mysqldump
docker exec -it ggm_mysql_1 mysqldump -u dbuser -psecret eccubedb > var/tmp/backup/eccubedb_dump_`date "+%Y%m%d"`.sql
echo "dump all database /var/tmp/backup"


# composer update
if [ $ENV = "prod" ];  then
/usr/local/php7.1/bin/php composer.phar update
else
php composer.phar update
fi

# Delete cache:
rm -fR var/cache/dev/*
rm -fR var/cache/prod/*

# dev env only
if [ $ENV = "dev" ];  then
# db dump
docker exec -it ggm_mysql_1 mysqldump -u dbuser -psecret eccubedb > var/tmp/dump_`date "+%Y%m%d_%H%M%S"`.sql
# docker
docker-compose up -d
docker-compose ps -a
else
  echo "Here is not dev env."
fi

# comoposer optimaze
if [ $ENV = "prod" ];  then
/usr/local/php7.1/bin/php composer.phar update -o
/usr/local/php7.1/bin/php composer.phar dump-autoload -o
else
php composer.phar update -o
php composer.phar dump-autoload -o
fi

exit

