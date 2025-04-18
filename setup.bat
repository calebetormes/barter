@echo off
title Setup Laravel - Núcleo do Projeto
echo ================================
echo  INICIANDO SETUP DO PROJETO
echo ================================

:: 2.3 - Instala as dependências do Laravel
echo Instalando dependencias PHP...
composer install

:: 2.4 - Cria o arquivo .env manualmente
IF EXIST ".env" (
    echo Arquivo .env ja existe. Pulando esta etapa.
) ELSE (
    echo Criando arquivo temporario de configuracao .env...
    echo APP_NAME=Laravel > temp_env.txt
    echo APP_ENV=local >> temp_env.txt
    echo APP_KEY= >> temp_env.txt
    echo APP_DEBUG=true >> temp_env.txt
    echo APP_URL=http://localhost >> temp_env.txt

    echo LOG_CHANNEL=stack >> temp_env.txt
    echo LOG_DEPRECATIONS_CHANNEL=null >> temp_env.txt
    echo LOG_LEVEL=debug >> temp_env.txt

    echo DB_CONNECTION=mysql >> temp_env.txt
    echo DB_HOST=127.0.0.1 >> temp_env.txt
    echo DB_PORT=3306 >> temp_env.txt
    echo DB_DATABASE=barter >> temp_env.txt
    echo DB_USERNAME=root >> temp_env.txt
    echo DB_PASSWORD= >> temp_env.txt

    echo SESSION_DRIVER=file >> temp_env.txt
    echo SESSION_LIFETIME=120 >> temp_env.txt

    echo VITE_APP_NAME="${APP_NAME}" >> temp_env.txt

    :: Usa o comando type para garantir criação do .env
    type temp_env.txt > ".env"
    del temp_env.txt
)

:: 2.5 - Gera a chave da aplicação
echo Gerando chave do Laravel...
php artisan key:generate

:: 2.6 - Instala dependências do Vue.js (Vite)
echo Instalando dependencias do Vite (npm)...
npm install

echo Iniciando o Vite...
start cmd /k "npm run dev"

echo.
echo Setup concluido!
echo Agora configure o restante do .env e rode:
echo     php artisan migrate
pause
