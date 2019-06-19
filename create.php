    <?php
    include 'header.php';
    include_once 'config.php';

    if ($_POST['add']) {
        $name              = (!empty($_POST['nom'])) ? mysqli_real_escape_string($connect, $_POST['nom']) : "";
        $age               = (!empty($_POST['age'])) ? mysqli_real_escape_string($connect, $_POST['age']) : "";
        $mail              = (!empty($_POST['mail'])) ? mysqli_real_escape_string($connect, $_POST['mail']) : "";
        $url               = (!empty($_POST['url'])) ? mysqli_real_escape_string($connect, $_FILES['url']['name']) : "";
        //On recupere le fichier du input files(parcourir)
        if (isset($_FILES['url']) && $_FILES['url']['error'] == 0) {
            if ($_FILES['url']['size'] <= 1000000) {
                $infosfichier = pathinfo($_FILES['url']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees)) {
                    $filename = basename($_FILES['url']['name']);
                    move_uploaded_file($_FILES['url']['tmp_name'], 'img/' . $filename);
                    $myurl = "img/" . $filename;
                }
            }
        }
    } else {
        echo 'Certains champs sont vides veuillez ressaisir vos données';
    }
//On verifie que tous les champs soit completés
    if (empty($name) || empty($age) || empty($mail)) {
        if (empty($name)) {
            echo "<font color='red'>Name field is empty</font><br>";
        }
        if (empty($age)) {
            echo "<font color='red'>Age field is empty</font><br>";
        }
        if (empty($mail)) {
            echo "<font color='red'>Mail field is empty</font><br>";
        }
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        //On inject dans la base de donnée les elements récuperés
        $result = mysqli_query($connect, "INSERT INTO users(name,age,email,url) VALUES('$name','$age','$mail','$myurl')");
        echo "<h3 style='color:green;text-align:center'>Vos données ont bien été enregistrées.</h3>";
        echo "<br/><a href='index.php'>Voir les enregistrements</a>";
    }

    include 'footer.php';
    ?>