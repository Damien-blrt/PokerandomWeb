<?php
require '../vendor/autoload.php';

$router = new AltoRouter();

// Helper pour l'affichage
function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Helper pour l'API
function getPokemonData($url)
{
    $json = @file_get_contents($url);
    if (!$json) return null;
    $data = json_decode($json, true);

    $types = [0 => 'None', 1 => 'Normal', 2 => 'Feu', 3 => 'Eau', 4 => 'Plante', 5 => 'Electrik', 6 => 'Glace', 7 => 'Combat', 8 => 'Poison', 9 => 'Sol', 10 => 'Vol', 11 => 'Psy', 12 => 'Insecte', 13 => 'Roche', 14 => 'Spectre', 15 => 'Dragon', 16 => 'Tenebres', 17 => 'Acier', 18 => 'Fee'];

    if ($data) {
        $data['type1'] = $types[$data['type1']] ?? 'Inconnu';
        $data['type2'] = $types[$data['type2']] ?? 'None';
    }
    return $data;
}

// --- DÉFINITION DES ROUTES ---

// 1. Home (Utilise ton fichier random.php existant)
$router->map('GET', '/', function () {
    $pokemon = getPokemonData("https://pokerandom.onrender.com/api/Pokemon/random");
    $title = "Accueil";
    ob_start();
    require '../views/random.php';
    $content = ob_get_clean();
    require '../views/layout.php';
}, 'home');

// 2. Trio Aléatoire
$router->map('GET', '/trio', function () {
    $pokemons = [];
    for ($i = 0; $i < 3; $i++) {
        $pokemons[] = getPokemonData("https://pokerandom.onrender.com/api/Pokemon/random");
    }
    $title = "Trio Aléatoire";
    ob_start();
    require '../views/trio.php';
    $content = ob_get_clean();
    require '../views/layout.php';
}, 'trio');

// 3. Recherche par numéro
$router->map('GET', '/search', function () {
    $pokemon = null;
    $id = $_GET['id'] ?? null;
    if ($id) {
        $pokemon = getPokemonData("https://pokerandom.onrender.com/api/Pokemon/" . (int)$id);
    }
    $title = "Recherche";
    ob_start();
    require '../views/search.php';
    $content = ob_get_clean();
    require '../views/layout.php';
}, 'search');

$match = $router->match();
if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 - Page non trouvée";
}
