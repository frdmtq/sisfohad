<script>
function validateForm()
{
var x=document.forms["form1"]["nid"].value;
var x1=document.forms["form1"]["nama"].value;
var x2=document.forms["form1"]["umur"].value;
var x3=document.forms["form1"]["photo"].value;
if (x==null || x=="")
  {
  alert("Isi Nomor Induk Dosen");
  return false;
  }
if (x1==null || x1=="")
  {
  alert("Isi Nama Dosen");
  return false;
  }
  if (x2==null || x2=="")
  {
  alert("Isi Umur Dosen");
  return false;
  }
  if (x3==null || x3=="")
  {
  alert("Photo tidak ada,dipilih secara default");
  return true;
  x3="default";
  }
}
</script>
<?php
ob_start();
$ids=$_GET['id'];
$q=mysql_query("Select * from dosen where sha1(nid)='".$ids."'");
$r=mysql_fetch_array($q);
?>
<form method="post" class="form-horizontal" name="form1" id="form1" enctype="multipart/form-data" onsubmit="return validateForm()"  />
<div class="control-group">
<label class="control-label">Nomor Induk Dosen</label>
<div class="controls">
<input name="nid" type="text" id="nid" value="<?php echo $r['nid']; ?>" readonly>
</div>
</div>
<div class="control-group">
<label class="control-label">Nama Dosen</label>
<div class="controls">
<input type="text" name="nama" id="nama" value="<?php echo $r['nama']; ?>" class="input-xlarge">
</div>
</div>
<div class="control-group">
<label class="control-label">Umur</label>
<div class="controls">
<input type="text" name="umur" id="umur" value="<?php echo $r['umur']; ?>" class="input-small">&nbsp;
</div>
</div>

<div class="control-group">
<label class="control-label">Photo</label>
<div class="controls">
<input type="text" name="photo" id="photo"  value="<?php echo $baseurl."uploads/dosen/".$r['photo']; ?>" onClick="window.open('<?php echo $baseurl; ?>includes/imguploads/index.php','popuppage','width=600,toolbar=0,resizable=0,scrollbars=no,height=400,top=100,left=100');"/>
<img src="<?php echo $baseurl."uploads/dosen/".$r['photo']; ?>" width="300px" height="300px"/>
<input type="hidden" name="ext" id="ext" />
<input type="hidden" name="nfile" id="nfile" />
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
	$eks=$_POST['ext'];
	$namabaru=$_POST['nid'].".".$eks;		
	
	$upload_dir = $path_web."uploads/dosen/";

	if($_POST['photo']!="")
	{
		if (file_exists($upload_dir) && is_writable($upload_dir)) {
	file_put_contents($upload_dir.$namabaru,fopen($_POST['photo'], 'r'));	
		
		}else {
			echo 'Upload directory is not writable, or does not exist.';
		}
		$q=mysql_query("Update dosen SET nama='".$_POST['nama']."',umur='".$_POST['umur']."',photo='".$namabaru."' Where nid='".$_POST['nid']."'") or die(mysql_error());
		if($q)
		{
			echo "<script>alert('Berhasil diubah');window.location='?cat=akademik&page=dosen'</script>";
		}
	}else{
		$q=mysql_query("Update dosen SET nama='".$_POST['nama']."',umur='".$_POST['umur']."' Where nid='".$_POST['nid']."'") or die(mysql_error());
		if($q)
		{
		echo "<script>alert('Berhasil diubah');window.location='?cat=akademik&page=dosen'</script>";
		}
	}
	
	
}
?>
<?php
ob_end_flush();
?>
