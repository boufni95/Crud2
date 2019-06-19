<?php
// Inclusion de la config pour connexion a la base de donnée 
include_once("config.php");

//Je regarde si j'ai l'id soit par $_GET ou par $8POST et je le récupere
if (isset($_GET['id'])) $id = $_GET['id'];
if (isset($_POST['update'])) {

	//Si j'ai l'id alors je récupere les infos du $_POST que je mets dans des variables
	if (!isset($id)) $id = mysqli_real_escape_string($connect, $_POST['id']);
	$name 	= mysqli_real_escape_string($connect, $_POST['name']);
	$age 	= mysqli_real_escape_string($connect, $_POST['age']);
	$email 	= mysqli_real_escape_string($connect, $_POST['email']);
	if (isset($_POST['url'])) {
		$url    = mysqli_real_escape_string($connect, $_POST['url']);
	}else{
		$url="";
	}
	// Verification si des champs sont vides
	if (empty($name) || empty($age) || empty($email)) {

		if (empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}

		if (empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}

		if (empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
	} else {

		//On récupere les valeurs du input parcourir
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
			
		//Connexion a la base de donnée pour update
		$result = mysqli_query($connect, "UPDATE users SET name='$name',age='$age',email='$email',url='$myurl' WHERE id=$id");

		//Redirection vers la page d'accueil
		header("Location: index.php");
	}
}

// Connexion a la base de donnee qui récupere toutes les infos du id sur lequel on est
$result = mysqli_query($connect, "SELECT * FROM users WHERE id=$id");

//On place dans des variables toutes les infos reçu
while ($res = mysqli_fetch_array($result)) {
	$name = $res['name'];
	$age = $res['age'];
	$email = $res['email'];
	$url = $res['url'];
}
?>

<!-- Affichage du resultat en HTML -->
<?php include 'header.php'; ?>

<h1 style="text-align:center">Mise a jour de la fiche <?= $name ?></h1>
<div class="form_update">
	<form name="form1" method="post" action="update.php" id="form1" enctype="multipart/form-data">
		<table border="0">
			<tr>
				<td class="label">Name</td>
				<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
			</tr>
			<tr>
				<td class="label">Age</td>
				<td><input type="text" name="age" value="<?php echo $age; ?>"></td>
			</tr>
			<tr>
				<td class="label">Email</td>
				<td><input type="text" name="email" value="<?php echo $email; ?>"></td>
			</tr>
			<tr>
				<td class="label">image</td>
				<td><input type="file" name="url" file='<?= $url ?>'></td>
			</tr>
			<tr>
				<div>
					<td><input type="hidden" name="id" value=<?php echo $id; ?>></td>
					<td><input type="submit" name="update" value="Update">
						<input type="reset" value="Effacer"></td>
				</div>
			</tr>
		</table>
	</form>
</div>

<!-- On place ici le footer -->
<?php
include 'footer.php';
?>