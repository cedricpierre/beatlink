#!/bin/sh
echo "Starting services..."
service php8.3-fpm start -d variables_order=EGPCS
nginx -g "daemon off;"
echo "Ready."
