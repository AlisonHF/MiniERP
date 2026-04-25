<div align="center">

# ⚡ WorkUp

**Mini ERP web — clientes, produtos, vendas e usuários multiempresa.**

[![PHP](https://img.shields.io/badge/PHP-7.4%20%7C%208.2-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.x-EF4223?logo=codeigniter&logoColor=white)](https://codeigniter.com/userguide3/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Docker](https://img.shields.io/badge/Docker-ready-2496ED?logo=docker&logoColor=white)](https://www.docker.com/)

</div>

---

## Sobre

Sistema de gestão simples com **isolamento por empresa** (multi-tenant), feito em **CodeIgniter 3 + PHP 7.4** —
stack que utilizo no trabalho atualmente. A imagem Docker roda em **PHP 8.2 + Apache**, demonstrando
compatibilidade do código com versões mais recentes da linguagem. O projeto serve como vitrine prática de
organização de código, boas práticas de segurança e integrações com APIs públicas.

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

**Backend:** PHP 7.4 (compatível com 8.2), CodeIgniter 3, MySQL 5.7
**Container:** PHP 8.2 + Apache (`mod_rewrite` habilitado)
**Frontend:** Bootstrap 5.3, jQuery 3.7, jquery.mask, SweetAlert2, Bootstrap Icons
**Integrações:** [ViaCEP](https://viacep.com.br/) (CEP) e [BrasilAPI](https://brasilapi.com.br/) (CNPJ) — gratuitas, sem auth

## Subindo com Docker (recomendado)

Pré-requisitos: **Docker Desktop** com Compose v2.

```bash
git clone <url-do-repositorio> workup
cd workup

# Copia os templates de config (não versionados)
cp application/config/database.example.php application/config/database.php
cp application/config/email.example.php    application/config/email.php

# Sobe a stack (app + mysql)
docker compose up -d --build
```

Pronto. Acesse: <http://localhost:8080>

> Os scripts em [`docker/mysql/init/`](docker/mysql/init/) criam o schema e populam os dados iniciais
> automaticamente na **primeira inicialização** do MySQL.

### Portas expostas

| Serviço | Host | Container |
|---|---|---|
| App (Apache) | `8080` | `80` |
| MySQL | `3307` | `3306` |

Pra conectar no MySQL via DBeaver/HeidiSQL/TablePlus: `localhost:3307` com usuário `workup` / senha `123456`.

> ⚠️ **Credenciais do `docker-compose.yml` são apenas para desenvolvimento.** Em produção,
> use variáveis de ambiente ou um arquivo `.env` fora do repositório.

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
