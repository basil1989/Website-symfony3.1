#!/bin/bash
git pull origin deploy

args=("$@")
ELEMENTS=${#args[@]}

for (( i=0;i<$ELEMENTS;i++)); do

        if [ ${args[${i}]} == 'bower' ]; then
                rm -rf web/assets
                bower install
        fi


        if [ ${args[${i}]} == 'composer' ]; then
                rm -rf vendor
                rm -f composer.lock
                composer install
        fi

        if [ ${args[${i}]} == 'db' ]; then
                php bin/console d:s:u --force
        fi


done

php bin/console cache:clear -e dev
php bin/console cache:clear -e prod



