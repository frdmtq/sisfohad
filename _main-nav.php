<!--NAVIGASI MENU UTAMA-->

<div class="leftmenu">
  <ul class="nav nav-tabs nav-stacked">
    <li class="active"><a href="dashboard.php"><span class="icon-align-justify"></span> Dashboard</a></li>
    
    <!--MENU GUDANG-->
    <?php
	if($_SESSION['login_hash']=="akademik")
	{
	?>
    <li class="dropdown"><a href="#"><span class="icon-th-list"></span> Data Master</a>
      <ul>
        <li><a href="?cat=akademik&page=jurusan">Data Jurusan</a></li>
        <li><a href="?cat=akademik&page=matkul">Mata Kuliah</a></li>
       <li><a href="?cat=akademik&page=kelas">Data Kelas</a></li>
       <li><a href="?cat=akademik&page=dosen">Data Dosen</a></li>
       <li><a href="?cat=akademik&page=mahasiswa">Data Mahasiswa</a></li>
       <li><a href="?cat=akademik&page=jadwal">Jadwal Kuliah</a></li>
      </ul>
    </li>   
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Konfigurasi</a>
      <ul>
        <li><a href="?cat=akademik&page=configabsen">Konfigurasi Absen</a></li>
      </ul>
    </li>           
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan</a>
      <ul>
        <li><a href="?cat=akademik&page=laptengah">Laporan per tengah Semester (Mahasiswa)</a></li>
   <li><a href="?cat=akademik&page=lapfull">Laporan per Semester (Mahasiswa)</a></li>
     <li><a href="?cat=akademik&page=laptengah2">Laporan per tengah Semester (Dosen)</a></li>
   <li><a href="?cat=akademik&page=lapfull2">Laporan per Semester (Dosen)</a></li>
      </ul>
    </li>        
   <!--MENU PIMPINAN-->
        <?php
	}elseif($_SESSION['login_hash']=="pimpinan"){
	?>    
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan</a>
      <ul>       
        <li><a href="?cat=pimpinan&page=eoq">Fixed Order Interval</a></li> 
        <li><a href="?cat=pimpinan&page=monthreporting">Laporan Bulanan</a></li>
              
      </ul>
    </li>
     <!--MENU ADMIN-->
        <?php
	}elseif($_SESSION['login_hash']=="administrator"){
	?>    
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> System</a>
      <ul>       
        <li><a href="?cat=administrator&page=user">User Management</a></li> 
        <li><a href="?cat=administrator&page=deletetemp">Delete Temporary Uploads</a></li> 
        
      </ul>
    </li>
  	<?php
	}
	?>
  </ul>
</div>
<!--leftmenu-->

</div>
<!--mainleft--> 
<!-- END OF LEFT PANEL -->