#!/bin/bash

docker-compose up -d
docker-compose ps -a
sleep 5
docker exec ec-cube_mysql_1 mysqldump -u dbuser -psecret eccubedb < var/tmp/develop_dump.sql
