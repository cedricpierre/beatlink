#!/bin/sh
echo "Starting services..."
service php8.3-fpm start
/usr/sbin/php-fpm8.3 -F -R -d variables_order=EGPCS
nginx -g "daemon off"
echo "Ready."
