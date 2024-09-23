#!/bin/sh
echo "Starting services..."
mkdir /run/php
/usr/sbin/php-fpm8.3 -F -R -d variables_order=EGPCS
nginx -g "daemon off"
echo "Ready."
