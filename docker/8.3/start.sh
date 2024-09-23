#!/bin/sh
echo $APP_KEY
echo "Starting services..."
service php8.3-fpm start -d variables_order=EGPCS
nginx -g "daemon off;error_log /dev/stdout debug;"
echo "Ready."
tail -s 1 /var/log/nginx/*.log -f
