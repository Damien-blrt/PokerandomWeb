<div class="text-center mb-5">
    <h1>Sélectionnez un Pokémon</h1>
    <p class="text-muted">Choisissez-en un pour l'ajouter à votre équipe et en générer 3 nouveaux.</p>
    <a href="/trio" class="btn btn-primary btn-sm mt-2">Générer 3 nouveaux Pokémon</a>
    <a href="/index.php?reset_team=1" class="btn btn-danger btn-sm mt-2">Réinitialiser mon équipe</a>
</div>

<div class="row">
    <?php foreach ($pokemons as $p): ?>
        <?php if ($p): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow border-0 h-100" style="border-radius: 20px;">
                    <div class="bg-primary py-3 text-white text-center" style="border-radius: 20px 20px 0 0;">
                        <h4 class="text-capitalize m-0"><?= h($p['name']) ?></h4>
                        <img
                            src="<?= pokemonImageUrl($p['id']) ?>"
                            alt="<?= h($p['name']) ?>"
                            loading="lazy"
                            class="img-fluid mx-auto d-block"
                            style="max-height: 200px;">
                        <small>N° <?= $p['id'] ?></small>
                    </div>
                    <div class="card-body text-center">
                        <span class="badge rounded-pill bg-secondary px-3"><?= $p['type1'] ?></span>
                        <?php if ($p['type2'] !== 'None'): ?>
                            <span class="badge rounded-pill bg-dark px-3"><?= $p['type2'] ?></span>
                        <?php endif; ?>

                        <p class="card-text small text-muted mt-3">"<?= h($p['description']) ?>"</p>

                        <a href="/trio?add=<?= $p['id'] ?>" class="btn btn-success w-100 rounded-pill mt-3">
                            Choisir <?= h($p['name']) ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if (empty($pokemons)): ?>
        <div class="card-body text-center" style="border-radius: 20px 20px 0 0;">
            <h4 class="text-capitalize m-0">Erreur dans le chargement des pokemons, rechargez l'api avec :</h4>
            <div class="card-body text-center">
                <a href="https://pokerandom.onrender.com/api/Pokemon" class="btn btn-primary w-100 mt-1">Ce lien ( peut prendre jusqu'à 2 minutes )</a>
            </div>
        </div>
    <?php endif; ?>

</div>

<hr class="my-5">

<div class="team-section">
    <h2 class="text-center mb-4">Mon Équipe constituée (<?= count($myTeam) ?>)</h2>

    <?php if (empty($myTeam)): ?>
        <div class="alert alert-info text-center">
            Vous n'avez pas encore sélectionné de Pokémon.
        </div>
    <?php else: ?>
        <div class="row justify-content-center">
            <?php foreach ($myTeam as $member): ?>
                <div class="col-6 col-md-2 mb-3">
                    <div class="card h-100 shadow-sm border-primary">
                        <div class="card-header p-1 text-center bg-primary text-white" style="font-size: 0.8rem;">
                            <?= h($member['name']) ?>
                        </div>
                        <img
                            src="<?= pokemonImageUrl($member['id']) ?>"
                            alt="<?= h($member['name']) ?>"
                            loading="lazy"
                            class="img-fluid mx-auto d-block"
                            style="max-height: 50px;">
                        <div class="card-body p-2 text-center">
                            <small class="d-block text-muted">N° <?= $member['id'] ?></small>
                            <span class="badge bg-secondary" style="font-size: 0.6rem;"><?= $member['type1'] ?></span>
                            <?php if ($member['type2'] !== 'None'): ?>
                                <span class="badge bg-dark" style="font-size: 0.6rem;"><?= $member['type2'] ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>