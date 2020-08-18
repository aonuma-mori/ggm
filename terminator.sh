#!/bin/bash

docker exec -it ec-cube_mysql_1 mysqldump -u dbuser -psecret eccubedb > var/tmp/develop_dump.sql
echo "backup develop_dump.sql"
docker-compose down
