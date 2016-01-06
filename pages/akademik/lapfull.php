<form method="post">
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
<input type="text" name="semester" id="semester" class="input-small">&nbsp;
</div>
</div>
<div class="control-group">
<div class="controls">
<input type="submit" name="simpan" class="btn btn-medium btn-primary" value="Cetak Data" />
</div>
</div>
</form>
<?php
if(isset($_POST['simpan']))
{
	echo "<script>window.location='".$baseurl."pages/web/lapabsen.php?semester=".$_POST['semester']."&blnadd=6&tipe=MAHASISWA&matkul=".$_POST['matkul']."'</script>";
}
?>