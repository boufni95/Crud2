<?php
//On inclut le header et le config pour se connecter a la base de donnée
include 'header.php';
include 'config.php';
if ($_POST['engine_search']) {
    //On ne fait l'interrogation de la base de donnée que si on a bien reçu le post
    $recherche = $_POST['search'];
    if (!empty($recherche)) {
//Requête qui recherche les information du input serarch(Recherche)
        $result = mysqli_query($connect, "SELECT * FROM users WHERE (name LIKE '%$recherche%') or (age LIKE '%$recherche%') or (email LIKE '%$recherche%');");

        //Ici on affiche le ou les résultats
        echo '<h2>Le résultat de vos recherches</h2>';
        
        echo '<div id="table">';
        $count = 0;

        //On parcours toutes les valeurs du tableau qui contiennent les résultats du search
        while ($res = mysqli_fetch_array($result)) {
            ++$count;
            echo '<table>';
            echo '<tr>';
            echo "<td>Nom :<a href=\"update.php?id=".$res['id']."\">" . $res['name'] . "</a></td><tr><td>Age :" . $res['age'] . "</td></tr><tr><td> Mail:" . $res['email'] . "</td></tr>";
            echo '</tr>';
            echo '</table>';
            echo '<hr>';
        }

        //Affichache du nombre de résultats obtenus
        if (isset($count)) {
            echo (isset($count) ? "<h3 style='color:green'>" . $count . " résultats pour votre recherche</h3>" : "<h3></h3>");
        }
        echo '</div>';
    } else {
        echo '<p style="color:#ef1037">Recherche à partir d\'un champ vide : aucun résultat pour votre requête</p>';
    }
}
include 'footer.php';
