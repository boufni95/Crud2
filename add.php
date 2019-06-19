<?php include 'header.php' ?>

<h1>Formulaire d'enregistrement</h1>

<div id="myform">
    <form action="create.php" method="post" enctype="multipart/form-data">
        <label for=nom>Nom</label><br>
        <input type="text" name="nom" id="nom" placeholder="Nom">
        <br>
        <label for=age>Age</label><br>
        <input type="text" name="age" id="age" placeholder="age">
        <br>
        <label for=mail>Mail</label><br>
        <input type="email" name="mail" id="mail" placeholder="mail" style='margin-bottom:20px'>
        <br>
        <label for="image_produit">Image<label>
        <input type="file" name="url" id="image_produit" />
        <br>
                <input type="submit" value="Envoyer" name='add'>
                <input type="reset" value="Effacer">
    </form>
</div>


<?php
include 'footer.php';
?>