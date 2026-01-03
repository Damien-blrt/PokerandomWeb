<?php
require '../vendor/autoload.php';

// 1. IMPORTANT : Démarrer la session tout en haut
session_start();

// Initialiser l'équipe si elle n'existe pas encore
if (!isset($_SESSION['team'])) {
    $_SESSION['team'] = [];
}

// Optionnel : Une route pour vider l'équipe (Reset complet)
if (isset($_GET['reset_team'])) {
    $_SESSION['team'] = [];
    header('Location: /trio');
    exit;
}

$router = new AltoRouter();

// Helper pour l'affichage
function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Helper pour l'API
function getPokemonData($url)
{
    // ... (Votre fonction existante, inchangée) ...
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

// Helper pour l'URL de l'image
function pokemonImageUrl(int $id): string
{
    return "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/$id.png";
}


// --- ROUTES ---

$router->map('GET', '/', function () {
    // ... (Votre route home inchangée) ...
    $pokemon = getPokemonData("https://pokerandom.onrender.com/api/Pokemon/random");
    $title = "Accueil";
    ob_start();
    require '../views/random.php';
    $content = ob_get_clean();
    require '../views/layout.php';
}, 'home');

// 2. Modification de la route TRIO
$router->map('GET', '/trio', function () {

    // A. LOGIQUE D'AJOUT : Si un ID est passé dans l'URL (ex: /trio?add=25)
    if (isset($_GET['add'])) {
        $idToAdd = (int)$_GET['add'];
        // On récupère les données précises du Pokémon choisi
        $newMember = getPokemonData("https://pokerandom.onrender.com/api/Pokemon/" . $idToAdd);

        if ($newMember) {
            // On l'ajoute à la session
            $_SESSION['team'][] = $newMember;
        }

        // On redirige vers /trio (sans paramètre) pour nettoyer l'URL et éviter de ré-ajouter en rafraîchissant
        header('Location: /trio');
        exit;
    }

    // B. GÉNÉRATION : On génère toujours 3 nouveaux aléatoires
    $pokemons = [];
    for ($i = 0; $i < 3; $i++) {
        $pokemons[] = getPokemonData("https://pokerandom.onrender.com/api/Pokemon/random");
    }

    // C. RÉCUPÉRATION DE L'ÉQUIPE (pour l'affichage)
    $myTeam = $_SESSION['team'];

    $title = "Trio Aléatoire";
    ob_start();
    require '../views/trio.php';
    $content = ob_get_clean();
    require '../views/layout.php';
}, 'trio');

// ... (Le reste du fichier routeur/search reste inchangé) ...
$router->map('GET', '/search', function () {
    // ... code search existant ...
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
