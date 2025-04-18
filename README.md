# 🚀 Projeto Laravel + Vue com Herd

Este repositório contém um projeto Laravel + Vue com Vite, pronto para rodar localmente usando o [Laravel Herd](https://herd.laravel.com), sem necessidade de XAMPP ou Apache.

---

## ✅ Requisitos

- [Laravel Herd](https://herd.laravel.com) instalado
- MySQL (instalado separadamente)
- Git
- Acesso à internet para instalar dependências

---

## 📦 Instalação do ambiente

### 1. Instale o Laravel Herd

O Herd já vem com PHP, Composer, Node, Nginx e Vite configurados.

➡️ [https://herd.laravel.com](https://herd.laravel.com)

Após instalar:
- Abra o **Laravel Herd**
- Ative o PHP na interface

---
🛠 Como adicionar o Node.js do Laravel Herd ao PATH (Windows)
Se você estiver utilizando o Laravel Herd e quiser usar o Node.js e o NPM diretamente no terminal, será necessário adicionar o caminho dos binários ao PATH do sistema.

📍 Passo a passo:
Abra o Explorador de Arquivos e vá até a pasta: (copie esse caminho)
C:\Users\SEU_USUARIO\.config\herd\bin\nvm\v23.11.0

Abra as variáveis de ambiente do Windows:
Na seção "Variáveis do Sistema", encontre a variável chamada Path e clique em Editar.
Clique em Novo e cole o caminho copiado anteriormente:
Clique em OK para fechar todas as janelas.
Feche e reabra o terminal (CMD, PowerShell ou terminal do VS Code).

✅ Testando
Abra um novo terminal e digite:

node -v
npm -v

Você deverá ver algo como:

v23.11.0
9.x.x

### 2. Instale o MySQL (sem XAMPP)

Baixe e instale o **MySQL Server** (somente) usando o instalador oficial:

➡️ [https://dev.mysql.com/downloads/installer/](https://dev.mysql.com/downloads/installer/)

> Durante a instalação:
> - Configure o usuário `root`
> - Defina uma senha (ou deixe em branco se preferir simplicidade)

---

### 3. Crie o banco de dados

Você pode usar o **MySQL Workbench**, **DBeaver** ou terminal para criar:

```sql
CREATE DATABASE barter CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### 4. Clone o projeto

No terminal:

```bash
git clone https://github.com/seu-usuario/seu-projeto.git
cd seu-projeto
```

---

### 5. Rode o script de instalação (opcional)

Se o repositório contém um arquivo `setup.bat`, execute:

```bash
setup.bat
```

Ou siga manualmente:

```bash
copy .env.example .env
php artisan key:generate
composer install
npm install
npm run dev
php artisan migrate
```

---

### 6. Configure o arquivo `.env`

Edite as variáveis de ambiente com os dados do seu banco:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=          # será gerada pelo artisan
APP_DEBUG=true
APP_URL=http://barter.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=barter
DB_USERNAME=root
DB_PASSWORD=      # sua senha
```

---

### 7. Acesse no navegador

Se o projeto está na pasta `C:\www\barter`, acesse:

```
http://barter.test
```

> O domínio `.test` é gerenciado automaticamente pelo Herd.

---

## 💡 Dicas úteis

- Erro `vite: comando não encontrado`: rode `npm install`
- Erro 500: confira se o `.env` tem `APP_KEY` e o banco está acessível
- Permissão PowerShell: execute `Set-ExecutionPolicy RemoteSigned` como admin

---

## 🧪 Testes e Migrations

```bash
php artisan migrate
php artisan test
```

---

## 🛠️ Tecnologias usadas

- Laravel
- Vue 3 + Vite
- Laravel Herd (PHP, Composer, Node, Nginx)
- MySQL

---

## 📌 Sobre

Este projeto foi configurado para facilitar o desenvolvimento local com mínimo esforço de setup. Ideal para equipes que usam Laravel no backend e Vue no frontend.
