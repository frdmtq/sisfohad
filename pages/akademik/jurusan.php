<?php
ob_start();
?>
<form name="form1" method="post" action="?cat=akademik&page=jurusan&act=1">
  <label>Jurusan Baru</label>

      <input type="text" name="nama_jurusan" id="nama_jurusan">    
   
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
    <td>Kode Jurusan</td>
    <td>Nama Jurusan</td>   
    <td>&nbsp;</td>
  </tr>
  <?php
  $rw=mysql_query("Select * from jurusan");
  while($s=mysql_fetch_array($rw))
  {
  ?>
  <tr>
    <td><?php echo $s['kode_jurusan']; ?></td>
    <td><?php echo $s['nama_jurusan']; ?></td>

    <td><a href="?cat=akademik&page=editjurusan&id=<?php echo sha1($s['kode_jurusan']); ?>">Edit</a> - <a href="?cat=akademik&page=jurusan&del=1&id=<?php echo sha1($s['kode_jurusan']); ?>">Hapus</a></td>
  </tr>
  <?php
  }
  ?>
</table>
</span>
<?php
if(isset($_GET['act']))
{
	
	$rs=mysql_query("Insert into jurusan (`nama_jurusan`) values ('".$_POST['nama_jurusan']."')") or die(mysql_error());
	if($rs)
	{
		echo "<script>window.location='?cat=akademik&page=jurusan'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysql_query("Delete from jurusan Where sha1(kode_jurusan)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=akademik&page=jurusan'</script>";
	}
}
?>
