<div align="left">
<h1>Data mahasiswa</h1>
</div>

<div align="right">
<button class="btn btn-medium btn-primary" type="button" onClick="window.location='?cat=akademik&page=addmahasiswa'">Tambah Data</button>

</div>
<span class="span4">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td>Nomor Induk mahasiswa</td>
    <td>Nama mahasiswa</td>  
    <td>Umur</td> 
    <td>Jurusan</td>
    <td>Photo</td>      
    <td>&nbsp;</td>
  </tr>
  <?php
  $rw=mysql_query("SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.umur, jurusan.nama_jurusan, mahasiswa.photo
FROM mahasiswa LEFT JOIN jurusan ON mahasiswa.kode_jurusan = jurusan.kode_jurusan");
  while($s=mysql_fetch_array($rw))
  {
  ?>
  <tr>
    <td><?php echo $s['nim']; ?></td>
    <td><?php echo $s['nama']; ?></td>
    <td><?php echo $s['umur']; ?></td>
    <td><?php echo $s['nama_jurusan']; ?></td>
    <td>  
    <?php if($s['photo']!="")
	{
		?>
    <img src="<?php echo $baseurl."uploads/mahasiswa/".$s['photo']; ?> " width="50px" height="50px">
    <?php
	}else{
	?>
    <img src="<?php echo $baseurl."uploads/files/no-photo.jpg"; ?>" width="50px" height="50px">
    <?php
	}
	?>
   	
    </td>

    <td><a href="?cat=akademik&page=editmahasiswa&id=<?php echo sha1($s['nim']); ?>">Edit</a> - <a href="?cat=akademik&page=mahasiswa&del=1&id=<?php echo sha1($s['nim']); ?>">Hapus</a></td>
  </tr>
  <?php
  }
  ?>
</table>
</span>
<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysql_query("Delete from mahasiswa Where sha1(nim)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=akademik&page=mahasiswa'</script>";
	}
}
?>
	<script type="text/javascript">
$(document).ready(function()
{
$("div.lightbox").bind("shown",function()
{
console.log("Shown Event",$(this).attr('id'));
});
});
</script>