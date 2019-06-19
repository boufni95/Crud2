<?php
$succes="false";
//On rappelle la page config
include_once 'config.php';
//Connexion à la base de données
$result = mysqli_query($connect, "SELECT * FROM users ");


// Fonction de nettoyage du tableaux $url
function  nettoye(array $tableau)
{
    $filename = [];
    for ($i = 0; $i < count($tableau); $i++) {
        $tableau[$i] = trim($tableau[$i], "\[\]\"");
        array_push($filename, $tableau[$i]);
    }
    return $filename;
}

//Récéption des données de Ajax
$myIndex = file_get_contents('php://input');

//Transformation des données en string
$index = Json_decode($myIndex, true)['myIndex'];
$url = json_decode($myIndex, true)['myurl'];

//Conversion des string en Array
$url = (explode(",", $url));
$index = (explode(",", $index));

//Nettoyage des tableaux grace a la fonction crée plus haut
$url = nettoye($url);
$index = nettoye($index);

//On parcours le tableau pour supprimer toutes les photos et mettre a jour la base de donnée
for ($i = 0; $i < count($url); $i++) {
    $fh = opendir('img');
    $filename = $url[$i];
    if (!empty($filename)) {
        //$filename = trim($filename, "\[\]\"");
        $success = unlink($filename);
        $url[$i] = $filename = "";
        $id = $index[$i];


        if ($result) {
            //Si on est connecté à la base alors mise a jour
            $result = mysqli_query($connect, "UPDATE users SET url='$filename' WHERE id=$id");
            $succes=true;
        }
    }

    closedir($fh);
}
$result = json.encode($succes);
return $result;
