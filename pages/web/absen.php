<div align="center">
<div><h1><?php echo $nama_aplikasi; ?></h1></div>
<hr />
<table width="50%" border="1">
  <tr>
    <td>
<?php
date_default_timezone_set('Asia/Jakarta');
$skrg=date("Y-m-d");
$qr=mysql_query("Select * from config");
$rqr=mysql_fetch_array($qr);
$limit="00:".$rqr['limit_absen'];
$limit_detik_absen=$rqr['limit_absen'];
if(isset($_SESSION['matkul']) && isset($_SESSION['jurusan']) && isset($_SESSION['semester']))
{
$q=mysql_query("SELECT jadwal_kuliah.id_jadwal, jadwal_kuliah.tanggal, jadwal_kuliah.jam_mulai,  jurusan.nama_jurusan, kelas.nama_kelas, dosen.nama as nama_dosen, jadwal_kuliah.semester, mata_kuliah.nama_mata_kuliah
FROM (((jadwal_kuliah LEFT JOIN dosen ON jadwal_kuliah.nid = dosen.nid) LEFT JOIN jurusan ON jadwal_kuliah.kode_jurusan = jurusan.kode_jurusan) LEFT JOIN kelas ON jadwal_kuliah.kode_kelas = kelas.kode_kelas) LEFT JOIN mata_kuliah ON jadwal_kuliah.kode_mata_kuliah = mata_kuliah.kode_mata_kuliah where jadwal_kuliah.tanggal='".$skrg."' and jadwal_kuliah.kode_mata_kuliah='".$_SESSION['matkul']."' and jadwal_kuliah.kode_jurusan='".$_SESSION['jurusan']."' and jadwal_kuliah.semester='".$_SESSION['semester']."'") or die(mysql_error());
$rq=mysql_fetch_array($q);
$rc=mysql_num_rows($q);

	if($rc=="0")
	{
		
		unset($_SESSION['matkul']);
		unset($_SESSION['jurusan']);
		unset($_SESSION['semester']);
		
		echo "<script>alert('tidak ditemukan');window.location='absen.php'</script>";
	}else{
				
		
		$midnight = strtotime("00:00");
		$jam_mulai=$skrg." ".$rq['jam_mulai'];
		$tskrg=date("h:i");
		$newtimestamp = strtotime($skrg.' '.$rq['jam_mulai'].' + '.$limit_detik_absen.' minute');
		$jam_habis=date('Y-m-d H:i:s', $newtimestamp);
		$format24=substr($tskrg,0,2);
		if($format24=="12")
		{
			$format24="00";
		}
		$jskrg=$skrg." ".$format24.":".date("i").":00";		
		$limitok=$newtimestamp - strtotime($jskrg);
		
		$l1=$newtimestamp- strtotime($jam_mulai);
		
		if($limitok > $l1)
		{
			unset($_SESSION['matkul']);
		unset($_SESSION['jurusan']);
		unset($_SESSION['semester']);
		echo "<script>alert('Absen belum dibuka');window.location='absen.php'</script>";
		}
		
		if($limitok < 0 )
		{
			$k_jadwal=$rq['id_jadwal'];
			echo "<h3>TENGGAT ABSEN SUDAH HABIS</h3>"."<br>";
			echo "<h3>MAHASISWA YANG HADIR</h3>"."<br>";
			$td=mysql_query("Select * from data_absen_dosen where id_jadwal='".$k_jadwal."'");
			$rtd=mysql_fetch_array($td);
			$td2=mysql_query("Select * from dosen where nid='".$rtd['nid']."'");
			$rtd2=mysql_fetch_array($td2);
			?>
            Dosen : <?php echo "<h3>".$rtd2['nama']."</h3>"."<br>"; ?>
            <?php
			$ta=mysql_query("Select * from data_absen_mhs where id_jadwal='".$k_jadwal."'") or die(mysql_error());
			?>
			<table width="100%" border="0" class="table table-condensed">
  <tr>
    <td width="12%">NIM</td>
    <td width="18%">NAMA</td>
    <td width="70%">PHOTO</td>
  </tr>
<?php
			while($rta=mysql_fetch_array($ta))
			{
				
				$qmhs=mysql_query("Select * from mahasiswa where nim='".$rta['nim']."'") or die(mysql_error());
				while($rmhs=mysql_fetch_array($qmhs))
				{
					
					?>
                   <tr>
					<td><?php echo $rmhs['nim']; ?></td>
					<td><?php echo $rmhs['nama']; ?></td>
					<td><img src="<?php echo $baseurl."uploads/mahasiswa/".$rmhs['photo']; ?>" width="50px" height="50px" /></td>
				  </tr>
                    <?php
				}
			}
			?>
            </table><p>&nbsp;</p>
            <button class="btn btn-medium btn-primary" type="button" onClick="window.location='<?php echo $baseurl."absen.php?c=1"; ?>'">Cari Lain</button>
            <?php
			/*echo "<script>window.location='absen.php?c=1'</script>";*/
		}else{
		?>
        <p>Tenggat Waktu Absen <h2><span id="counter"><?php echo $limitok; ?></span> detik.</h2></p>
		<script type="text/javascript">
        function countdown() {
            var i = document.getElementById('counter');
            i.innerHTML = parseInt(i.innerHTML)-1;
            if (parseInt(i.innerHTML)<=0) {
                location.href = 'absen.php?c=1';
                i.innerHTML='5';
            }
            
        }
        setInterval(function(){ countdown(); },1000);
        </script>
        
        <div style="background-color:#FFFFFF">
        <?php
		$g1=mysql_query("Select * from jurusan where kode_jurusan='".$_SESSION['jurusan']."'");
		$rg1=mysql_fetch_array($g1);
		$g2=mysql_query("Select * from mata_kuliah where kode_mata_kuliah='".$_SESSION['matkul']."'");
		$rg2=mysql_fetch_array($g2);
		echo "<h4>Jurusan = <strong>".$rq['nama_jurusan']."</strong></h4>";
		echo "<h4>Mata Kuliah = <strong>".$rq['nama_mata_kuliah']."</strong></h4>";
		echo "<h4>Nama Dosen = <strong>".$rq['nama_dosen']."</strong></h4>";
		echo "<h4>Kelas = <strong>".$rq['nama_kelas']."</strong></h4>";
		echo "<h4>Semester = <strong>".$rq['semester']."</strong></h4>";
		?>
        <form name="formabsen" method="post">
        <input type="hidden" name="idjadwal" value="<?php echo $rq['id_jadwal']; ?>" />
        <div class="control-group">
        <label>Jenis</label>
        <div class="controls">
        <select name="jenis">
        <option value="1">Mahasiswa</option>
        <option value="2">Dosen</option>        
        </select>
        </div>
        </div>
        <div class="control-group">
        <label>NIM / NID</label>
        <div class="controls">
        <input type="text" name="kode" />
        </div>
        </div>
        <div class="control-group">
		<div class="controls">
        <input type="submit" class="btn btn-medium btn-primary" name="simpanabsen" value="Absen" />		</div></div>
        </form>        
        </div>
        <p>&nbsp;</p>        
<button class="btn btn-medium btn-primary" type="button" onClick="window.location='<?php echo $baseurl."absen.php?c=1"; ?>'">Cari Lain</button>
<?php
		}
		?>
        <?php
	}
}else{
?>
<form name="form1" method="post">
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
<label>Semester</label>
<input type="text" name="semester" class="input-small" />
<p></p>
<input type="submit" name="cari" value="Cari" class="btn btn-medium btn-primary" />
</form>
<?php
}
?>
<?php
if(isset($_POST['cari']))
{
	$_SESSION['matkul']=$_POST['matkul'];
	$_SESSION['jurusan']=$_POST['jurusan'];
	$_SESSION['semester']=$_POST['semester'];
	echo "<script>window.location='absen.php'</script>";
}
if(isset($_GET['c']))
{
	unset($_SESSION['matkul']);
		unset($_SESSION['jurusan']);
		unset($_SESSION['semester']);
		echo "<script>window.location='absen.php'</script>";
}
?>

<?php
if(isset($_POST['simpanabsen']))
{

	if($_POST['jenis']=="1")
	{
		$chm1=mysql_query("Select * from mahasiswa where nim='".$_POST['kode']."'");
		$rchm1=mysql_num_rows($chm1);
		if($rchm1==1)
		{
			$ch1=mysql_query("Select * from data_absen_mhs where id_jadwal='".$_POST['idjadwal']."' and nim='".$_POST['kode']."'");
			$rch1=mysql_num_rows($ch1);
			if($rch1==0)
			{
			$sql1=mysql_query("Insert into data_absen_mhs (`id_jadwal`,`nim`,`tgl`,`jam`,`semester`,`kode_mata_kuliah`) values ('".$_POST['idjadwal']."','".$_POST['kode']."','".$skrg."','".$jskrg."','".$_SESSION['semester']."','".$_SESSION['matkul']."')");
				if($sql1)
				{
					unset($_SESSION['matkul']);
				unset($_SESSION['jurusan']);
				unset($_SESSION['semester']);
				echo "<script>alert('Terima Kasih sudah Absen');window.location='absen.php'</script>";
				}
			}else{
				unset($_SESSION['matkul']);
			unset($_SESSION['jurusan']);
			unset($_SESSION['semester']);
			echo "<script>alert('Anda sudah absen');window.location='absen.php'</script>";
			}
		}else{
			unset($_SESSION['matkul']);
			unset($_SESSION['jurusan']);
			unset($_SESSION['semester']);
			echo "<script>alert('Orang Lain dilarang absen');window.location='absen.php'</script>";
		}
	}elseif($_POST['jenis']=="2")
	{
		$chm2=mysql_query("Select * from dosen where nid='".$_POST['kode']."'") or die(mysql_error());
		$rchm2=mysql_num_rows($chm2);
		if($rchm2==1)
		{
			$ch2=mysql_query("Select * from data_absen_dosen where id_jadwal='".$_POST['idjadwal']."' and nid='".$_POST['kode']."'");
			$rch2=mysql_num_rows($ch2);
			if($rch2==0)
			{
			$sql2=mysql_query("Insert into data_absen_dosen (`id_jadwal`,`nid`,`tgl`,`jam`,`semester`,`kode_mata_kuliah`) values ('".$_POST['idjadwal']."','".$_POST['kode']."','".$skrg."','".$jskrg."','".$_SESSION['semester']."','".$_SESSION['matkul']."')");
				if($sql2)
				{
					unset($_SESSION['matkul']);
				unset($_SESSION['jurusan']);
				unset($_SESSION['semester']);
				echo "<script>alert('Terima Kasih sudah Absen');window.location='absen.php'</script>";
				}

			}else{
				unset($_SESSION['matkul']);
			unset($_SESSION['jurusan']);
			unset($_SESSION['semester']);
			echo "<script>alert('Anda sudah absen');window.location='absen.php'</script>";
			}
		}else{
			unset($_SESSION['matkul']);
			unset($_SESSION['jurusan']);
			unset($_SESSION['semester']);
			echo "<script>alert('Orang Lain dilarang absen');window.location='absen.php'</script>";
		}
	}
		
}
?>
</td>
  </tr>
</table>
<hr>
<div align="center">
<h3>
<?php
echo $label_footer;
?>
</h3>
</div>
</div>


