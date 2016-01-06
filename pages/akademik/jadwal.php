<div align="left">
<h1>Data Jadwal Kuliah</h1>
</div>

<div align="right">
<button class="btn btn-medium btn-primary" type="button" onClick="window.location='?cat=akademik&page=addjadwal'">Tambah Data</button>

</div>
<span class="span4">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td>No. ID</td>
    <td>Tanggal</td>  
    <td>Jam Mulai</td> 
    <td>Jurusan</td>      
    <td>Kelas</td>
    <td>Dosen</td>
    <td>Mata Kuliah</td>
    <td>Semester</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  $rw=mysql_query("SELECT jadwal_kuliah.id_jadwal, jadwal_kuliah.tanggal, jadwal_kuliah.jam_mulai,  jurusan.nama_jurusan, kelas.nama_kelas, dosen.nama, jadwal_kuliah.semester, mata_kuliah.nama_mata_kuliah
FROM (((jadwal_kuliah LEFT JOIN dosen ON jadwal_kuliah.nid = dosen.nid) LEFT JOIN jurusan ON jadwal_kuliah.kode_jurusan = jurusan.kode_jurusan) LEFT JOIN kelas ON jadwal_kuliah.kode_kelas = kelas.kode_kelas) LEFT JOIN mata_kuliah ON jadwal_kuliah.kode_mata_kuliah = mata_kuliah.kode_mata_kuliah");
  while($s=mysql_fetch_array($rw))
  {
  ?>
  <tr>
    <td><?php echo $s['id_jadwal']; ?></td>
    <td><?php echo $s['tanggal']; ?></td>
    <td><?php echo $s['jam_mulai']; ?></td>   
    <td><?php echo $s['nama_jurusan']; ?></td>
    <td><?php echo $s['nama_kelas']; ?></td>
    <td><?php echo $s['nama']; ?></td>
    <td><?php echo $s['nama_mata_kuliah']; ?></td>
    <td><?php echo $s['semester']; ?></td>
    <td>     
   	
    </td>

    <td><a href="?cat=akademik&page=editjadwal&id=<?php echo sha1($s['id_jadwal']); ?>">Edit</a> - <a href="?cat=akademik&page=jadwal&del=1&id=<?php echo sha1($s['id_jadwal']); ?>">Hapus</a></td>
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
	$ff=mysql_query("Delete from jadwal_kuliah Where sha1(id_jadwal)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=akademik&page=jadwal'</script>";
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