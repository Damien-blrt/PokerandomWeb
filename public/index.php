<?php
require '../vendor/autoload.php';

/* =========================
   SESSION
========================= */
session_start();

if (!isset($_SESSION['team'])) {
    $_SESSION['team'] = [];
}

if (isset($_GET['reset_team'])) {
    $_SESSION['team'] = [];
    header('Location: /trio');
    exit;
}

/* =========================
   ROUTER
========================= */
$router = new AltoRouter();

/* =========================
   HELPERS
========================= */
function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function getPokemonData(string $url): ?array
{
    $json = @file_get_contents($url);
    if (!$json) return null;
    return json_decode($json, true);
}

function pokemonImageUrl(int $id): string
{
    return "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/$id.png";
}

function pokemonGeneration(int $id): int
{
    return match (true) {
        $id <= 151 => 1,
        $id <= 251 => 2,
        $id <= 386 => 3,
        $id <= 493 => 4,
        $id <= 649 => 5,
        $id <= 721 => 6,
        $id <= 809 => 7,
        $id <= 905 => 8,
        default => 9,
    };
}

/* =========================
   NORMALISATION
========================= */
function normalizePokemon(array $pokemon): array
{
    $pokemon['type1'] = is_array($pokemon['type1'])
        ? ($pokemon['type1']['name'] ?? 'Inconnu')
        : ($pokemon['type1'] ?? 'Inconnu');

    $pokemon['type2'] = is_array($pokemon['type2'])
        ? ($pokemon['type2']['name'] ?? 'None')
        : ($pokemon['type2'] ?? 'None');

    return $pokemon;
}

/* =========================
   ROUTES
========================= */

/* ---- HOME ---- */
$router->map('GET', '/', function () {
    $pokemon = getPokemonData("https://pokerandom.onrender.com/api/Pokemon/random");
    if ($pokemon) {
        $pokemon = normalizePokemon($pokemon);
    }

    $title = "Accueil";
    ob_start();
    require '../views/random.php';
    $content = ob_get_clean();
    require '../views/layout.php';
}, 'home');

/* ---- TRIO ---- */
$router->map('GET', '/trio', function () {

    /* AJOUT À L'ÉQUIPE */
    if (isset($_GET['add'])) {
        $id = (int)$_GET['add'];
        $pokemon = getPokemonData("https://pokerandom.onrender.com/api/Pokemon/$id");

        if ($pokemon) {
            $_SESSION['team'][] = normalizePokemon($pokemon);
        }

        header('Location: /trio');
        exit;
    }

    /* GÉNÉRATION DE 3 POKÉMON */
    $pokemons = [];
    for ($i = 0; $i < 3; $i++) {
        $p = getPokemonData("https://pokerandom.onrender.com/api/Pokemon/random");
        if ($p) {
            $pokemons[] = normalizePokemon($p);
        }
    }

    $myTeam = $_SESSION['team'];
    $title = "Trio Aléatoire";

    ob_start();
    require '../views/trio.php';
    $content = ob_get_clean();
    require '../views/layout.php';
}, 'trio');

/* ---- SEARCH ---- */
$router->map('GET', '/search', function () {
    $pokemon = null;
    if (!empty($_GET['id'])) {
        $pokemon = getPokemonData("https://pokerandom.onrender.com/api/Pokemon/" . (int)$_GET['id']);
        if ($pokemon) {
            $pokemon = normalizePokemon($pokemon);
        }
    }

    $title = "Recherche";
    ob_start();
    require '../views/search.php';
    $content = ob_get_clean();
    require '../views/layout.php';
}, 'search');

/* =========================
   DISPATCH
========================= */
$match = $router->match();
if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 - Page non trouvée";
}
