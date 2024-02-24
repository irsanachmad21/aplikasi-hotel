<?php 

require_once("../config/koneksi.php");

$pencarian = @$_POST['pencarian'];

$query = "SELECT tb_pembayaran.id_pembayaran, tb_pemesanan.id_pemesanan, tb_kamar.id_kamar,
        tb_pembayaran.metode_pembayaran, tb_pembayaran.total_pembayaran
        FROM tb_pembayaran
        INNER JOIN tb_pemesanan ON tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan
        INNER JOIN tb_kamar ON tb_pemesanan.id_kamar = tb_kamar.id_kamar
        WHERE tb_pembayaran.id_pembayaran LIKE '%$pencarian%' OR tb_pemesanan.id_pemesanan LIKE '%$pencarian%'
        OR tb_pemesanan.id_kamar LIKE '%$pencarian%';";


$result = $mysqli->query($query);

?>

<table id="reservasi" align=center>  
    <tr>
        <th align=left>Id Pembayaran</th>
        <th align=left>Id Pemesanan</th>
        <th align=left>Id Kamar</th>
        <th align=left>Metode Pembayaran</th>
        <th align=left>Total Pembayaran</th>
        <th>Action</th>
    </tr>

    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>".$row["id_pembayaran"]."</td>";
            echo "<td>".$row["id_pemesanan"]."</td>";
            echo "<td>".$row["id_kamar"]."</td>";
            echo "<td>".$row["metode_pembayaran"]."</td>";
            echo "<td> Rp ".$row["total_pembayaran"]."</td>";
            echo "<td align='center'>
                    <a href='pembayaran-form.php?act=edit&id_pembayaran=".$row['id_pembayaran']."'><img src='../../img/update.png' width='25px'></a>
                    <a href='pembayaran-form.php?act=delete&id_pembayaran=".$row['id_pembayaran']."'><img src='../../img/delete.png' width='25px''></a></td>";
        echo "</tr>";
    }

    $result->free_result();
    $mysqli->close();
    ?>
</table>