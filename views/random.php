<?php $title = "Générateur Aléatoire"; ?>

<div class="row justify-content-center text-center">
    <div class="col-md-6">
        <h1 class="display-5 mb-4">Attrapez-les tous !</h1>

        <a href="/" id="generateBtn" class="btn btn-warning btn-lg px-5 shadow-sm mb-5">
            <span id="btnText"><strong>Générer un Pokémon</strong></span>
            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
        </a>

        <script>
            document.getElementById('generateBtn').addEventListener('click', function(e) {
                document.getElementById('btnText').innerText = "Chargement...";
                document.getElementById('btnSpinner').classList.remove('d-none');
                this.classList.add('disabled');
            });
        </script>

        <?php if (isset($pokemon)): ?>
            <div class="card shadow border-0 mx-auto" style="width: 22rem; border-radius: 20px; overflow: hidden;">
                <div class="bg-primary py-4 text-white">
                    <h2 class="text-capitalize m-0"><?= h($pokemon['name']) ?></h2>
                    <img
                        src="<?= pokemonImageUrl($pokemon['id']) ?>"
                        alt="<?= h($pokemon['name']) ?>"
                        loading="lazy"
                        class="img-fluid mx-auto d-block"
                        style="max-height: 200px;">
                    <small>N° <?= $pokemon['id'] ?></small>
                    <span class="badge bg-info">Gén <?= pokemonGeneration($pokemon['id']) ?></span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge rounded-pill bg-secondary px-3"><?= $pokemon['type1'] ?></span>
                        <?php if ($pokemon['type2'] !== 'None'): ?>
                            <span class="badge rounded-pill bg-dark px-3"><?= $pokemon['type2'] ?></span>
                        <?php endif; ?>
                    </div>
                    <p class="card-text fst-italic text-muted">
                        "<?= h($pokemon['description']) ?>"
                    </p>
                </div>
            </div>
        <?php else: ?>
            <div class="card-body text-center" style="border-radius: 20px 20px 0 0;">
                <h4 class="text-capitalize m-0">Erreur ou chargement long ?</h4>
                <p class="mt-2">Si rien ne s'affiche, l'API est peut-être en veille.</p>
                <div class="card-body text-center">
                    <a href="https://pokerandom.onrender.com/api/Pokemon" target="_blank" class="btn btn-primary w-100 mt-1">
                        Réveiller l'API (peut prendre 2 min)
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>