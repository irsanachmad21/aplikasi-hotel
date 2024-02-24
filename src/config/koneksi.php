<?php 

    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "hotel";

    $mysqli = new mysqli($server, $user, $password, $db);

    // cek koneksi
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: ". $mysqli->connect_errno;
        exit();
    }

    function query ($query) {
        global $conn;
        global $mysqli;
        $result = mysqli_query($mysqli, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }
    
    function cari ($pencarian) {
        $query_pelanggan = "SELECT * FROM tb_pelanggan
                    WHERE
                    id_pelanggan LIKE '%$pencarian%' OR
                    nama_pelanggan LIKE '%$pencarian%';
        ";
    }

?>