<div class="row justify-content-center text-center">
    <div class="col-md-6">
        <h1 class="mb-4">Trouver un Pokémon</h1>
        <form action="/search" method="GET" class="mb-5 d-flex gap-2">
            <input type="number" name="id" class="form-control form-control-lg" placeholder="Entrez un numéro (ex: 25)" required>
            <button type="submit" class="btn btn-primary">Chercher</button>
        </form>

        <?php if (isset($pokemon) && $pokemon): ?>
            <div class="card shadow border-0 mx-auto" style="width: 22rem; border-radius: 20px;">
                <div class="bg-danger py-4 text-white" style="border-radius: 20px 20px 0 0;">
                    <h2 class="text-capitalize m-0"><?= h($pokemon['name']) ?></h2>
                    <small>N° <?= $pokemon['id'] ?></small>
                </div>
                <div class="card-body">
                    <span class="badge rounded-pill bg-secondary px-3"><?= $pokemon['type1'] ?></span>
                    <?php if ($pokemon['type2'] !== 'None'): ?>
                        <span class="badge rounded-pill bg-dark px-3"><?= $pokemon['type2'] ?></span>
                    <?php endif; ?>
                    <p class="mt-3 italic">"<?= h($pokemon['description']) ?>"</p>
                </div>
            </div>
        <?php elseif (isset($_GET['id'])): ?>
            <div class="alert alert-warning">Aucun Pokémon trouvé avec ce numéro.</div>
        <?php endif; ?>
    </div>
</div>