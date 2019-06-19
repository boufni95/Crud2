<?php
include_once('config.php');
include 'header.php'
?>

<h1 class="index_h1">Affichage des données</h1>
<table>
    <tr style="color:white;width:80%;border:0;background-color:rgba(136, 169, 241, 0.87)">
        <th style='width:8%;text-align:left;font-size:1.2rem'> Name</th>
        <th style='width:8%;font-size:1.2rem'> Age</th>
        <th style='width:8%;font-size:1.2rem'> Mail</th>
        <th style='width:8%;font-size:1.2rem'>Image <input type="checkbox" class="th_check"  style='margin-bottom:0'></th>
        <th style='width:8%;font-size:1.2rem'> Action</th>
    </tr>
    <?php
    $result = mysqli_query($connect, "SELECT * FROM users ORDER BY id DESC");

    while ($res = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "	<td style='text-align:left'>" . $res['name'] . "</td>";
        echo "	<td style='text-align:center'>" . $res['age'] . "</td>";
        echo "	<td style='text-align:center'>" . $res['email'] . "</td>";
        echo "<td style='text-align:center'><img src='" . $res['url'] . "' alt='image en attente' style='width:60px'>
        <input type='checkbox' id='$res[id]' onclick='suppression(this)'></td>";
        echo "	<td style='text-align:center'><a href=\"update.php?id=$res[id]\" style='margin-left:2%' class='edit'>Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Confirmez-vous cette suppression ?')\" class='edit'>Supprimer</a></td>";
        echo "</tr>";
    }
    ?>
</table>
<?php
include 'footer.php';
?>