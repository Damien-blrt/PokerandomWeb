<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'PokéRandom' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* On s'assure que le HTML et le BODY prennent 100% de la hauteur */
        html,
        body {
            height: 100%;
        }

        .navbar-brand {
            font-weight: bold;
            color: #ffcb05 !important;
            text-shadow: 2px 2px #3b4cca;
        }

        body {
            background-color: #f0f2f5;
        }

        /* Style du footer */
        .footer {
            background: #343a40;
            color: white;
            text-align: center;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .nav-link:hover {
            color: #ffcb05 !important;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">POKÉ-RANDOM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/trio">Trio Aléatoire</a></li>
                    <li class="nav-item"><a class="nav-link" href="/search">Chercher par N°</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1 container">
        <?= $content ?>
    </main>

    <footer class="footer py-3 mt-auto">
        <div class="container">
            <span class="text small">Réalisé par Damien Ballerat</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>