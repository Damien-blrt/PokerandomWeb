<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'PokéRandom' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #ffcb05 !important;
            text-shadow: 2px 2px #3b4cca;
        }

        body {
            background-color: #f0f2f5;
            min-height: 100vh;
        }

        .footer {
            margin-top: auto;
            py: 3;
            background: #343a40;
            color: white;
            text-align: center;
        }
    </style>
</head>

<body class="d-flex flex-column">
    <nav class="navbar navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">POKÉ-RANDOM</a>
        </div>
    </nav>

    <main class="container">
        <?= $content ?>
    </main>

    <footer class="footer py-3">
        <div class="container">
            <span class="text small">Réalisé par Damien Ballerat</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>