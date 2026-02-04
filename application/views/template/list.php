<div class="container-fluid auth-page list-page">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">

            <div class="list-wrapper">

                <div class="list-header">
                    <?php foreach (array_keys($data[0]) as $header): ?>
                        <span><?= $header ?></span>
                    <?php endforeach; ?>
                    <span>Ações</span>
                </div>

                <div class="list-body">

                    <?php if (empty($data)): ?>
                        <div class="empty-row">
                            Nenhum registro encontrado
                        </div>
                    <?php else: ?>
                        <?php foreach ($data as $registers): ?>

                            <div class="list-row">
                                <?php foreach ($registers as $register): ?>
                                    <span><?= $register ?></span>
                                <?php endforeach ?>
                            
                                <span class="actions">

                                    <?php if (!empty($actions)): ?>
                                        <?php foreach ($actions as $action): ?>
                                            <a href="<?= $action['url'] ?>" class="btn btn-<?= $action['class'] ?>">
                                                <i class="bi <?= $action['icon'] ?>"></i>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </span>
                            </div>
                
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>

            <div class="list-footer mt-3">
                <?= $links ?>
            </div>

        </div>
    </div>
</div>

<script>
    // Contagem de colunas dinamicas
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.list-wrapper').forEach(wrapper => {
            const header = wrapper.querySelector('.list-header');
            if (!header)
                return;

            const columns = header.children.length;
            wrapper.style.setProperty('--columns', columns);
        });
    });
</script>
