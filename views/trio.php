<div class="text-center mb-5">
    <h1>Votre équipe de 3</h1>
    <a href="/trio" class="btn btn-success px-4 mt-2 shadow-sm">Générer un autre trio</a>
</div>

<div class="row">
    <?php foreach ($pokemons as $p): ?>
        <?php if ($p): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow border-0 h-100" style="border-radius: 20px;">
                    <div class="bg-primary py-3 text-white text-center" style="border-radius: 20px 20px 0 0;">
                        <h4 class="text-capitalize m-0"><?= h($p['name']) ?></h4>
                        <small>N° <?= $p['id'] ?></small>
                    </div>
                    <div class="card-body text-center">
                        <span class="badge rounded-pill bg-secondary px-3"><?= $p['type1'] ?></span>

                        <?php if ($p['type2'] !== 'None'): ?>
                            <span class="badge rounded-pill bg-dark px-3"><?= $p['type2'] ?></span>
                        <?php endif; ?>

                        <p class="card-text small text-muted mt-3">"<?= h($p['description']) ?>"</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>