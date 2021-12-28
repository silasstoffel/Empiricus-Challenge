#!/bin/sh

APP_NETWORK='empiricus-network'
ENV_FILE='.env';
ENV_FILE_EXAMPLE='.env.example'

echo "";

docker-compose build

if [ -z "$(docker network ls --filter name=^${APP_NETWORK}$ --format="{{ .Name }}")" ]; then
    echo "$(date '+%Y-%m-%d %H:%M:%S,%3N') $(tput bold)$(tput setaf 4)INFO$(tput sgr0) Criando docker network da aplicação: ${APP_NETWORK}."
    docker network create ${APP_NETWORK}
fi

echo ""
echo "Verificação do .env";

if [ -f "$ENV_FILE" ]; then
    echo "$FILE já existe."
else
    echo "Criando o $FILE"
    cp $ENV_FILE_EXAMPLE $ENV_FILE
fi

echo "Iniciando container ...";

docker-compose up --remove-orphans --force-recreate

echo "Parando container ...";
docker-compose down

echo ""
