<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkUp</title>

    <link rel="icon" type="image/svg+xml" href="<?= base_url('favicon.svg') ?>">
    <link rel="alternate icon" href="<?= base_url('favicon.ico') ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="<?= base_url('assets/global.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <?php if (!empty($css)): ?>
        <?php foreach ($css as $file): ?>
            <link href="<?= base_url() . 'assets/'. $file . '.css'?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif; ?>
    
</head>
<body>
    <div class="page">
        <?php
            $currentSection = isset($this) ? $this->uri->segment(1) : '';
            $menuItems = [
                'produto' => ['label' => 'Produtos',  'icon' => 'bi-box-seam'],
                'cliente' => ['label' => 'Clientes',  'icon' => 'bi-people'],
                'venda'   => ['label' => 'Vendas',    'icon' => 'bi-receipt'],
                'usuario' => ['label' => 'Usuários',  'icon' => 'bi-person-badge'],
            ];
        ?>
        <nav class="navbar navbar-expand-md app-navbar" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= isset($user) && !empty($user) ? base_url('home') : base_url() ?>">
                    <i class="bi bi-lightning-charge-fill"></i>
                    <span>WorkUp</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php if (isset($user) && !empty($user)): ?>
                        <ul class="navbar-nav me-auto">
                            <?php foreach ($menuItems as $key => $item): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $currentSection === $key ? 'active' : '' ?>" href="<?= base_url($key) ?>">
                                        <i class="bi <?= $item['icon'] ?>"></i>
                                        <span><?= $item['label'] ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <a class="btn btn-sm btn-outline-light navbar-logout" href="<?= base_url('auth/logout') ?>">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sair</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <?php if (isset($user) && !empty($user)): ?>
            <?= breadcrumb_helper() ?>
        <?php endif; ?>

        <main>
            <?= $content ?? '' ?>
        </main>
    
        <footer class="bg-dark text-white text-center py-3">
            <p class="mb-0">
                <i class="bi bi-lightning-charge-fill text-primary"></i>
                &copy; 2025 WorkUp. Todos os direitos reservados.
            </p>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		
    <?php if (!empty($js)): ?>
        <?php foreach ($js as $file): ?>
            <script src="<?= base_url() . 'assets/' . $file . '.js' ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>
