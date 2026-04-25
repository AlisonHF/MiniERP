-- ============================================================
-- WorkUp - Dados iniciais
-- Popula tabelas de catálogo (executado após 01-schema.sql)
-- ============================================================

-- Tipos de usuário (IDs fixos referenciados pela aplicação)
INSERT INTO `tipo_usuario` (`id`, `descricao`) VALUES
    (1, 'Funcionário'),
    (2, 'Administrador'),
    (3, 'Fundador');
