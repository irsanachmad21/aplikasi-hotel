<?php 

require_once("../config/koneksi.php");

$id_pelanggan = $_POST['id_pelanggan'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$no_telp = $_POST['no_telp'];
$alamat = $_POST['alamat'];
$act = $_POST['act'];
$id = $_POST['id'];

if ($act == "edit") {
    $sql = "UPDATE tb_pelanggan SET id_pelanggan='$id_pelanggan', nama_pelanggan='$nama_pelanggan', no_telp='$no_telp', alamat='$alamat' WHERE id_pelanggan='$id_pelanggan'";
} else if ($act == "delete") {
    $sql = "DELETE FROM tb_pelanggan WHERE id_pelanggan='$id_pelanggan'";
} else {
    $stmt = $mysqli->prepare("INSERT INTO tb_pelanggan VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $a, $b, $c, $d);

    // set parameters and execute
    $a = $id_pelanggan;
    $b = $nama_pelanggan;
    $c = $no_telp;
    $d = $alamat;
    
    if ($stmt->execute()) {
        echo "<script>alert('Sukses');window.open('pelanggan-form.php','_self');</script>";
    }
}

if ($mysqli->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $mysqli->error;
}

echo "<script>alert('Sukses');window.open('pelanggan-form.php','_self');</script>";
$mysqli->close();
?>

?>