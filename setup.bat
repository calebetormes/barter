@echo off
title Setup Laravel - Núcleo do Projeto
echo ================================
echo  INICIANDO SETUP DO PROJETO
echo ================================

:: 2.3 - Instala as dependências do Laravel
echo Instalando dependencias PHP...
composer install

:: 2.4 - Copia o arquivo .env.example para .env
IF EXIST ".env" (
    echo Arquivo .env ja existe. Pulando esta etapa.
) ELSE (
    echo Criando arquivo .env a partir do exemplo...
    powershell -Command "Copy-Item -Path '.env.example' -Destination '.env'"
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
echo Agora configure o banco de dados no .env e rode:
echo     php artisan migrate
pause
