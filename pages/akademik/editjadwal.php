<script src="js/jquery-ui.js"></script>
<script>
$(function() {
$("#datepicker3").datepicker({        
		 dateFormat: "yy-mm-dd",
    });
});
</script>
<?php
ob_start();
$ids=$_GET['id'];
$gj=mysql_query("Select * from jadwal_kuliah where sha1(id_jadwal)='".$ids."'");
$rgj=mysql_fetch_array($gj);
?>
<form method="post" class="form-horizontal" name="form1" id="form1" enctype="multipart/form-data" onsubmit="return validateForm()"  />
<div class="control-group">
<label class="control-label">Tanggal</label>
<div class="controls">
<input type="text" name="tgl" id="datepicker3" class="input-small" value="<?php echo $rgj['tanggal']; ?>">
</div>
</div>
<div class="control-group">
<label class="control-label">Jam Mulai</label>
<div class="controls">
<input type="text" name="jam" id="jam" class="input-small" value="<?php echo $rgj['jam_mulai']; ?>">Ex. 15:45
</div>
</div>
<div class="control-group">
<label class="control-label">Jurusan</label>
<div class="controls">
<?php
$q=mysql_query("Select * from jurusan");
while($r=mysql_fetch_array($q))
{
?>
<select name="jurusan" id="jurusan">
<option value="<?php echo $r['kode_jurusan']; ?>"><?php echo $r['nama_jurusan']; ?></option>
</select>
<?php
}
?>
</div>
</div>
<div class="control-group">
<label class="control-label">Kelas</label>
<div class="controls">
<?php
$q=mysql_query("Select * from kelas");
while($r=mysql_fetch_array($q))
{
?>
<select name="kelas" id="kelas">
<option value="<?php echo $r['kode_kelas']; ?>"><?php echo $r['nama_kelas']; ?></option>
</select>
<?php
}
?>
</div>
</div>
<div class="control-group">
<label class="control-label">Dosen</label>
<div class="controls">
<?php
$q=mysql_query("Select * from dosen");
while($r=mysql_fetch_array($q))
{
?>
<select name="dosen" id="dosen">
<option value="<?php echo $r['nid']; ?>"><?php echo $r['nama']; ?></option>
</select>
<?php
}
?>
</div>
</div>
<div class="control-group">
<label class="control-label">Mata Kuliah</label>
<div class="controls">
<?php
$q=mysql_query("Select * from mata_kuliah");
while($r=mysql_fetch_array($q))
{
?>
<select name="matkul" id="matkul">
<option value="<?php echo $r['kode_mata_kuliah']; ?>"><?php echo $r['nama_mata_kuliah']; ?></option>
</select>
<?php
}
?>
</div>
</div>
<div class="control-group">
<label class="control-label">Semester</label>
<div class="controls">
<input type="text" name="semester" id="semester" class="input-small" value="<?php echo $rgj['semester']; ?>">&nbsp;
</div>
</div>
<div class="control-group">
<div class="controls">
<input type="submit" name="simpan" class="btn btn-medium btn-primary" value="Simpan Data" />
</div>
</div>
<?php
if(isset($_POST['simpan']))
{
	$q=mysql_query("Select count(id_jadwal) as rw from jadwal_kuliah where tanggal='".$_POST['tgl']."' and jam_mulai='".$_POST['jam']."' and kode_kelas='".$_POST['kelas']."'");
	$r=mysql_fetch_array($q);
	$jml=$r['rw'];
	if($jml=="0")
	{
		echo "Jadwal belum ada";
	}else{
		$q1=mysql_query("Update jadwal_kuliah 
		SET `tanggal`='".$_POST['tgl']."',`jam_mulai`='".$_POST['jam']."',`kode_jurusan`='".$_POST['jurusan']."',`kode_kelas`='".$_POST['kelas']."',`nid`='".$_POST['dosen']."',
		`semester`='".$_POST['semester']."',`kode_mata_kuliah`='".$_POST['matkul']."'
		Where sha1(id_jadwal)='".$_GET['id']."'");
		if($q1)
		{
			echo "<script>alert('Berhasil diubah');window.location='?cat=akademik&page=jadwal'</script>";
		}
	}
	
}
?>
<?php
ob_end_flush();
?>