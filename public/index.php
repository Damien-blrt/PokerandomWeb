<?php
require '../vendor/autoload.php';

// Fonction helper pour sécuriser l'affichage
function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

$router = new AltoRouter();

// Route Accueil
$router->map('GET', '/', function () {
    $title = "Accueil";
    ob_start(); // Démarre la capture du contenu
    require '../views/random.php';
    $content = ob_get_clean(); // Stocke le contenu de la vue dans $content
    require '../views/layout.php'; // Appelle le layout qui utilisera $content
}, 'home');

$router->map('GET', '/random', function () use ($router) {
    $apiUrl = "https://pokerandom.onrender.com/api/Pokemon/random";
    $json = @file_get_contents($apiUrl);
    $pokemon = $json ? json_decode($json, true) : null;

    if ($pokemon) {
        // On remplace les numéros par les noms
        $pokemon['type1'] = getTypeName($pokemon['type1']);
        $pokemon['type2'] = getTypeName($pokemon['type2']);
    }

    ob_start();
    require '../views/random.php';
    $content = ob_get_clean();
    require '../views/layout.php';
}, 'random');
// Match de la route
$match = $router->match();



if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // Page 404 simple
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 - Page non trouvée";
}

function getTypeName($id)
{
    $types = [
        0 => 'None',
        1 => 'Normal',
        2 => 'Feu',
        3 => 'Eau',
        4 => 'Plante',
        5 => 'Electrik',
        6 => 'Glace',
        7 => 'Combat',
        8 => 'Poison',
        9 => 'Sol',
        10 => 'Vol',
        11 => 'Psy',
        12 => 'Insecte',
        13 => 'Roche',
        14 => 'Spectre',
        15 => 'Dragon',
        16 => 'Tenebres',
        17 => 'Acier',
        18 => 'Fee'
    ];
    return $types[$id] ?? 'Inconnu';
}
