# 💻 Projeto Barter – Ambiente Laravel + Vue + Herd

## 📦 1. Preparando o ambiente

### ✅ Instalar o Node.js
Instale direto do site oficial: [https://nodejs.org/](https://nodejs.org/)

- Isso garante que o `npm` funcione sem problemas de PATH.
- Após a instalação, **libere o PowerShell para execução de scripts**:

```powershell
# Abra o PowerShell como Administrador e execute:
Set-ExecutionPolicy RemoteSigned
```
- Quando perguntado, digite `S` e pressione `Enter`.

---

### ✅ Instalar o MySQL Server
Você pode usar o instalador do site oficial: [https://dev.mysql.com/downloads/installer/](https://dev.mysql.com/downloads/installer/)

---

### ✅ Instalar o Visual Studio Code
Baixe aqui: [https://code.visualstudio.com/](https://code.visualstudio.com/)

---

### ✅ Instalar o [Laravel Herd](https://herd.laravel.com/)
Instala automaticamente:
- PHP
- NGINX
- Composer

---

✅ Com isso, seu ambiente terá:
- ✅ PHP
- ✅ NGINX
- ✅ Composer
- ✅ Node.js + npm
- ✅ MySQL

---

## 🚀 2. Rodando o projeto localmente

### 2.1 Criar o banco de dados

Use **MySQL Workbench**, **DBeaver** ou **terminal**:

```sql
CREATE DATABASE barter;
```

---

### 2.2 Clonar o projeto

```bash
git clone https://github.com/calebetormes/barter.git
cd barter
```

---

### 2.3 Instalar dependências PHP

```bash
composer install
```

---

### 2.4 Criar o arquivo `.env`

```bash
copy .env.example .env
```

---

### 2.5 Gerar chave da aplicação

```bash
php artisan key:generate
```

---

### 2.6 Configurar acesso ao banco de dados

No arquivo `.env`, altere as seguintes linhas:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=barter
DB_USERNAME=root
DB_PASSWORD=   # sua senha aqui
```

---

### 2.7 Instalar dependências do frontend (Vue.js + Vite)

```bash
npm install
npm run dev
```

---

### 2.8 Criar as tabelas com as migrations

```bash
php artisan migrate
```

---

## ✅ Pronto!
Agora você pode acessar o sistema via:
```
http://barter.test
```
Ou, se estiver usando `artisan serve`:
```
http://127.0.0.1:8000
```

---

📌 **Observação**: Caso esteja usando o HERD, o domínio `barter.test` será criado automaticamente.

---

🧑‍💻 Feito com ♥ por [calebetormes](https://github.com/calebetormes)

