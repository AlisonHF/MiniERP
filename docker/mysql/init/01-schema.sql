-- ============================================================
-- WorkUp - Schema completo
-- Executado automaticamente na primeira inicialização do MySQL
-- via docker-entrypoint-initdb.d
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------------
-- empresa
-- ------------------------------------------------------------
CREATE TABLE `empresa` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `razao_social` VARCHAR(255) NOT NULL,
    `nome_fantasia` VARCHAR(255) DEFAULT NULL,
    `cnpj` VARCHAR(18) NOT NULL,
    `inscricao_estadual` VARCHAR(15) DEFAULT NULL,
    `cep` VARCHAR(9) DEFAULT NULL,
    `endereco` VARCHAR(255) DEFAULT NULL,
    `bairro` VARCHAR(255) DEFAULT NULL,
    `numero` INT(11) DEFAULT NULL,
    `cidade` VARCHAR(255) DEFAULT NULL,
    `uf` VARCHAR(2) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_empresa_cnpj` (`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- tipo_usuario
-- ------------------------------------------------------------
CREATE TABLE `tipo_usuario` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `descricao` VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- usuario
-- ------------------------------------------------------------
CREATE TABLE `usuario` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `senha` VARCHAR(255) NOT NULL,
    `tipo_usuario` INT(11) DEFAULT NULL,
    `id_empresa` INT(11) DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_usuario_email` (`email`),
    KEY `fk_usuario_tipo` (`tipo_usuario`),
    KEY `fk_usuario_empresa` (`id_empresa`),
    CONSTRAINT `fk_usuario_tipo` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id`),
    CONSTRAINT `fk_usuario_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- cliente
-- ------------------------------------------------------------
CREATE TABLE `cliente` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `cpf` VARCHAR(15) DEFAULT NULL,
    `cnpj` VARCHAR(18) DEFAULT NULL,
    `nome` VARCHAR(255) DEFAULT NULL,
    `razao_social` VARCHAR(255) DEFAULT NULL,
    `apelido` VARCHAR(255) DEFAULT NULL,
    `nome_fantasia` VARCHAR(255) DEFAULT NULL,
    `inscricao_estadual` VARCHAR(30) DEFAULT NULL,
    `rg` VARCHAR(15) DEFAULT NULL,
    `tipo_pessoa` CHAR(1) NOT NULL,
    `data_nascimento` DATE DEFAULT NULL,
    `data_abertura` DATE DEFAULT NULL,
    `id_empresa` INT(11) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `fk_cliente_empresa` (`id_empresa`),
    CONSTRAINT `fk_cliente_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- produto
-- ------------------------------------------------------------
CREATE TABLE `produto` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `codigo` VARCHAR(20) NOT NULL,
    `descricao` VARCHAR(255) NOT NULL,
    `unidade` VARCHAR(10) DEFAULT NULL,
    `preco` DECIMAL(10,2) DEFAULT NULL,
    `id_empresa` INT(11) DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `fk_produto_empresa` (`id_empresa`),
    CONSTRAINT `fk_produto_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- venda
-- ------------------------------------------------------------
CREATE TABLE `venda` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `numero` VARCHAR(20) NOT NULL,
    `id_cliente` INT(11) NOT NULL,
    `id_usuario` INT(11) NOT NULL,
    `id_empresa` INT(11) NOT NULL,
    `status` ENUM('aberta','finalizada','cancelada') NOT NULL DEFAULT 'aberta',
    `observacao` TEXT DEFAULT NULL,
    `total` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_venda_numero_empresa` (`numero`,`id_empresa`),
    KEY `fk_venda_cliente` (`id_cliente`),
    KEY `fk_venda_usuario` (`id_usuario`),
    KEY `fk_venda_empresa` (`id_empresa`),
    CONSTRAINT `fk_venda_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
    CONSTRAINT `fk_venda_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`),
    CONSTRAINT `fk_venda_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- venda_item
-- ------------------------------------------------------------
CREATE TABLE `venda_item` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `id_venda` INT(11) NOT NULL,
    `id_produto` INT(11) NOT NULL,
    `id_empresa` INT(11) NOT NULL,
    `quantidade` DECIMAL(10,3) NOT NULL DEFAULT 1.000,
    `preco_unitario` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    `subtotal` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    PRIMARY KEY (`id`),
    KEY `fk_item_venda` (`id_venda`),
    KEY `fk_item_produto` (`id_produto`),
    KEY `fk_item_empresa` (`id_empresa`),
    CONSTRAINT `fk_item_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`),
    CONSTRAINT `fk_item_venda` FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_item_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- password_reset
-- ------------------------------------------------------------
CREATE TABLE `password_reset` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `id_usuario` INT(11) NOT NULL,
    `token` VARCHAR(128) NOT NULL,
    `expires_at` DATETIME NOT NULL,
    `used` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_password_reset_token` (`token`),
    KEY `fk_password_reset_usuario` (`id_usuario`),
    CONSTRAINT `fk_password_reset_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
