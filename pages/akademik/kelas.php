<?php
ob_start();
?>
<form name="form1" method="post" action="?cat=akademik&page=kelas&act=1">
  <label>kelas Baru</label>

      <input type="text" name="nama_kelas" id="nama_kelas">    
   
      <p></p>
      <input type="submit" class="btn btn-primary" name="button" id="button" value="Daftar">&nbsp;&nbsp;<input type="reset" class="btn btn-danger" name="reset" id="reset" value="Reset">
</form>
<?php
ob_end_flush();
?>
<p></p>
<p></p>
<span class="span4">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td>Kode kelas</td>
    <td>Nama kelas</td>   
    <td>&nbsp;</td>
  </tr>
  <?php
  $rw=mysql_query("Select * from kelas");
  while($s=mysql_fetch_array($rw))
  {
  ?>
  <tr>
    <td><?php echo $s['kode_kelas']; ?></td>
    <td><?php echo $s['nama_kelas']; ?></td>

    <td><a href="?cat=akademik&page=editkelas&id=<?php echo sha1($s['kode_kelas']); ?>">Edit</a> - <a href="?cat=akademik&page=kelas&del=1&id=<?php echo sha1($s['kode_kelas']); ?>">Hapus</a></td>
  </tr>
  <?php
  }
  ?>
</table>
</span>
<?php
if(isset($_GET['act']))
{
	
	$rs=mysql_query("Insert into kelas (`nama_kelas`) values ('".$_POST['nama_kelas']."')") or die(mysql_error());
	if($rs)
	{
		echo "<script>window.location='?cat=akademik&page=kelas'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysql_query("Delete from kelas Where sha1(kode_kelas)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=akademik&page=kelas'</script>";
	}
}
?>
