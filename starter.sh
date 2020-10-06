#!/bin/bash

# make dir
# var/cache
if [ ! -e ./var/cache ]; then
mkdir -m 777 ./var/cache
fi

# var/log
if [ ! -e ./var/log ]; then
mkdir -m 777 ./var/log
fi

# var/sessions
if [ ! -e ./var/sessons ]; then
mkdir -m 777 ./var/sessons
fi

# var/tmp
if [ ! -e ./var/tmp ]; then
mkdir -m 777 ./var/tmp
fi


# docker
docker-compose up -d
docker-compose ps -a
sleep 5

# initiarize
#docker-compose exec ec-cube composer run-script compile

# restore
docker exec ggm_mysql_1 mysqldump -u dbuser -psecret eccubedb < var/tmp/develop_dump.sql



