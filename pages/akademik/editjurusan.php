<?php
ob_start();
if(isset($_GET['id']))
{
	$rs=mysql_query("Select * from jurusan where sha1(kode_jurusan)='".$_GET['id']."'");
	$row=mysql_fetch_array($rs);
?>
<form name="form1" method="post" action="?cat=akademik&page=editjurusan&id=<?php echo $_GET['id']; ?>&edit=1">
  <table width="50%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="36%">Nama Jurusan</td>
      <td width="64%"><label for="jurusan"></label>
      <input type="text" name="jenis" id="jenis" value="<?php echo $row['nama_jurusan']; ?>"></td>
    </tr>
    
    
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" class="btn btn-primary" name="button" id="button" value="Ubah">&nbsp;&nbsp;<input type="button" class="btn btn-danger" name="reset" id="reset" value="Cancel" onclick="window.location='?cat=akademik&page=jurusan'"></td>
    </tr>
  </table>
</form>
<?php
ob_end_flush();
}else{
	echo "<script>window.location='?cat=akademik&page=jurusan'</script>";
}
?>
<?php
if(isset($_GET['edit']))
{
	
	$rs=mysql_query("Update jurusan SET nama_jurusan='".$_POST['jenis']."' Where sha1(kode_jurusan)='".$_GET['id']."'");
	if($rs)
	{
		echo "<script>window.location='?cat=akademik&page=jurusan'</script>";
	}
}
?>
