FROM nginx:alpine

ARG DEFAULT_PORT=80
ARG SERVER_NAME=_
ARG PHP_CONTAINER_HOST='app-php'
ARG PHP_CONTAINER_PORT=9000

RUN apk add --no-cache sed

COPY ./docker/nginx/confs/nginx.conf /etc/nginx/conf.d/default.conf

RUN sed -i "s/{DEFAULT_PORT}/$DEFAULT_PORT/" /etc/nginx/conf.d/default.conf \
 && sed -i "s/{SERVER_NAME}/$SERVER_NAME/" /etc/nginx/conf.d/default.conf \
 && sed -i "s/{PHP_CONTAINER_HOST}/$PHP_CONTAINER_HOST/" /etc/nginx/conf.d/default.conf \
 && sed -i "s/{PHP_CONTAINER_PORT}/$PHP_CONTAINER_PORT/" /etc/nginx/conf.d/default.conf