@echo off
echo ===========================================
echo  Iniciando setup do projeto Laravel + Vue
echo ===========================================

REM Verifica se o .env já existe
IF EXIST .env (
    echo .env já existe. Pulando cópia...
) ELSE (
    echo Copiando .env.example para .env...
    copy .env.example .env
)

echo Gerando APP_KEY...
php artisan key:generate

echo Instalando dependências PHP via Composer...
composer install

echo Instalando dependências JS via npm...
call npm install

echo Rodando Vite (modo dev)...
start npm run dev

echo Rodando migrations...
php artisan migrate

echo ===========================================
echo  Setup finalizado! 🚀
echo  Abra o navegador: http://localhost
echo ===========================================
pause
