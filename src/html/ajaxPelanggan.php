<?php 

require_once("../config/koneksi.php");

$pencarian = @$_POST['pencarian'];

$query = "SELECT * FROM tb_pelanggan WHERE
            id_pelanggan LIKE '%$pencarian%' OR
            nama_pelanggan LIKE '%$pencarian%' OR
            alamat LIKE '%$pencarian%';
        ";
$reservasi = query($query);
$result = $mysqli->query($query);

?>

<table id="reservasi" align=center>  
    <tr>
        <th align=left>Id Pelanggan</th>
        <th align=left>Nama Pelanggan</th>
        <th align=left>No Telp</th>
        <th align=left>Alamat</th>
        <th>Action</th>
    </tr>

    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>".$row["id_pelanggan"]."</td>";
            echo "<td>".$row["nama_pelanggan"]."</td>";
            echo "<td>".$row["no_telp"]."</td>";
            echo "<td>".$row["alamat"]."</td>";
            echo "<td align='center'>
                    <a href='pelanggan-form.php?act=edit&id_pelanggan=".$row['id_pelanggan']."'><img src='../../img/update.png' width='25px'></a>
                    <a href='pelanggan-form.php?act=delete&id_pelanggan=".$row['id_pelanggan']."'><img src='../../img/delete.png' width='25px''></a></td>";
        echo "</tr>";
    }

    $result->free_result();
    $mysqli->close();
    ?>
</table>