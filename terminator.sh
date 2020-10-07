#!/bin/bash

# dump all
docker exec -it ggm_mysql_1 mysqldump -u dbuser -psecret eccubedb > var/tmp/develop_dump.sql
echo "backup develop_dump.sql"

# marge to prod data
docker exec -it ggm_mysql_1 mysqldump -u dbuser -psecret eccubedb dtb_member > var/tmp/dev_dtb_member_dump.sql
echo "dump tables to merge for prod database."

docker-compose down
