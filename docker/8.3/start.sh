  #!/bin/sh\n\
echo "Starting services..."
service php8.3-fpm start
nginx -g "daemon off;"
echo "Ready."
tail -s 1 /var/log/nginx/*.log -f
