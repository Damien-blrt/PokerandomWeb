<?php
class PokemonController
{
    
    public function showRandom()
    {
        $pokemon = null;

        if (isset($_GET['generate'])) {
            $apiUrl = "https://pokerandom.onrender.com/api/Pokemon/random";
            $json = @file_get_contents($apiUrl);
            if ($json) {
                $pokemon = json_decode($json, true);
            }
        }

        require '../views/random.php';
    }
}
