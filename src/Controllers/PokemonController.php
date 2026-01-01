<?php
class PokemonController
{
    
    public function showRandom()
    {
        $pokemon = null;

        // Si on a cliqué sur le bouton (on passe un paramètre en GET ou juste on recharge)
        if (isset($_GET['generate'])) {
            $apiUrl = "https://pokerandom.onrender.com/api/Pokemon/random";
            $json = @file_get_contents($apiUrl);
            if ($json) {
                $pokemon = json_decode($json, true);
            }
        }

        // On charge la vue
        require '../views/random.php';
    }
}
