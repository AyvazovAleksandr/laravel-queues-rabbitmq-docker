FROM php:7.4-fpm-alpine

COPY ./compose/dev/workspace/run.sh /tmp

WORKDIR /var/www/html

ENTRYPOINT ["/tmp/run.sh"]