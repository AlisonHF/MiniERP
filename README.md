<div align="center">

# ⚡ WorkUp

**Mini ERP web — clientes, produtos, vendas e usuários multiempresa.**

[![PHP](https://img.shields.io/badge/PHP-7.4-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.x-EF4223?logo=codeigniter&logoColor=white)](https://codeigniter.com/userguide3/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

</div>

---

## Sobre

Sistema de gestão simples com **isolamento por empresa** (multi-tenant), feito em **CodeIgniter 3 + PHP 7.4** —
stack que utilizo no trabalho atualmente. O projeto serve como vitrine prática de organização de código,
boas práticas de segurança e integrações com APIs públicas.

## Destaques técnicos

- **Arquitetura em camadas** com **DTOs** tipados entre controller ↔ model
- **Multi-tenant nativo** — toda query filtra por `id_empresa` da sessão
- **Auto-discovery de assets** via loader customizado (`MY_Loader`)
- **Helpers reutilizáveis**: breadcrumb automático por URI, formatação de documentos, paginação
- **Recuperação de senha** com token de uso único (256 bits, expiração de 30 min) via SMTP
- **Controle de papéis** (Fundador / Administrador / Funcionário) com regras protegidas em front e back
- **Validações em duas camadas** (server-side com `form_validation` + reforço client-side)
- **Senhas** sempre com `password_hash(PASSWORD_DEFAULT)`
- **Configs sensíveis** fora do versionamento (`*.example.php` como template)

## Funcionalidades

| Módulo | Recursos |
|---|---|
| **Auth** | Login, logout, recuperação de senha por e-mail |
| **Empresa + Usuário** | Cadastro de empresa + fundador em transação atômica |
| **Clientes** | CRUD PF/PJ com auto-preenchimento via CNPJ |
| **Produtos** | CRUD com código único por empresa, máscara monetária |
| **Vendas** | Cabeçalho + itens, status (aberta/finalizada/cancelada), cálculo de totais |
| **Usuários** | Gestão de papéis com proteção de fundador |

## Stack

**Backend:** PHP 7.4, CodeIgniter 3, MySQL 5.7+
**Frontend:** Bootstrap 5.3, jQuery 3.7, jquery.mask, SweetAlert2, Bootstrap Icons
**Integrações:** [ViaCEP](https://viacep.com.br/) (CEP) e [BrasilAPI](https://brasilapi.com.br/) (CNPJ) — gratuitas, sem auth

## Instalação local

```bash
git clone <url-do-repositorio> workup
cd workup

# Copia os templates de config (não versionados)
cp application/config/database.example.php application/config/database.php
cp application/config/email.example.php    application/config/email.php
```

Edite `database.php` com as credenciais do MySQL e crie o banco:

```sql
CREATE DATABASE projeto_produtos
    DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Rode os scripts SQL fornecidos e suba o servidor:

```bash
php -S localhost:8080
```

## Docker

> _Em construção — `Dockerfile` (PHP 7.4 + Apache) e `docker-compose.yml` (app + MySQL) serão publicados em breve._

```bash
docker compose up -d --build
```

Variáveis esperadas: `CI_ENV`, `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`, `APP_URL`, `SMTP_HOST`, `SMTP_USER`, `SMTP_PASS`.

## Estrutura

```
application/
├── DTO/          → Data Transfer Objects (Create*/Update*)
├── controllers/  → Endpoints (Auth, Cliente, Produto, Venda, Usuario, Senha)
├── core/         → MY_Controller (sessão/auth) + MY_Loader (assets auto-load)
├── helpers/      → Breadcrumb, Format (CPF/CNPJ/CEP), Pagination
├── models/       → Acesso a dados por entidade
└── views/        → Agrupadas por módulo
assets/
├── css|js/<modulo>/<view>.{css,js}  → carregado automaticamente pela view
└── js/helpers/api.js                → ViaCEP + BrasilAPI
```

## Licença

MIT — veja [`license.txt`](license.txt).

---

<div align="center">

Feito por **Alison Faria** ⚡

</div>
