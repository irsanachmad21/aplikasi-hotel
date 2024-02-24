<?php
session_start();
include("../config/koneksi.php");
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	
</head>
<body>
<table border="0" width="97%" style="border-collapse:collapse;" cellpadding="0" cellspacing="0" align="center">
<tr>
  <td>&nbsp;&nbsp;&nbsp;
  
  <?php

	// $v_table = $_GET['p_t'];
	// $v_col_name = $_GET['p_col'];
	// $v_item = $_GET['p_item'];

    //-----------kumpulan setting query
        $q_query="SELECT * FROM tb_kamar";
        // echo "<font color='#dce6ed'>".$q_query."</font>";
	   //echo "$q_query";
       
	//-----------end kumpulan setting query

		$result=mysqli_query($mysqli,$q_query) ;
		//echo $result;
		
		
	
	?>
    <fieldset><legend><font><h3>&nbsp;Silahkan Pilih Kamar &nbsp;</h3></font></legend>
    <table border="0" width="100%" cellpadding="2" cellspacing="1" align="center" colspan="3">
      <tr height="25" align="center" class="header_data_table">
       	<th>Id Kamar</th>
       	<th>Tipe Kamar</th>
       	<th>Harga Kamar</th>
      </tr>
	<?php
	while ($row = mysqli_fetch_array($result)) {
			//echo $row["emp_name"];
	?>
	<tr  height="25" align="center">
		<td class="listdata">  
		<a href="javascript:window.opener.document.<?php echo $_GET['returnform']?>.fk_kamar.value='<?php echo strtoupper($row["id_kamar"])?>';
        window.opener.document.<?php echo $_GET['returnform']?>.id_kamar.value='<?php echo strtoupper($row["id_kamar"])?>';
        window.close()" style="text-decoration:none"><font color="<?php echo $color?>"><u><?php echo $row["id_kamar"];?></u></font></a>
		</td>
		<td class="listdata"><?php echo $row["tipe_kamar"];?> </td>
		<td class="listdata"><?php echo $row["harga_kamar"];?> </td>
	</tr>
	<?php
	}
		mysqli_free_result($result);
	?>
	</table>
	</fieldset>

</td><!-- TUTUP ISI -->
</tr>
</table>
</body>
</html>