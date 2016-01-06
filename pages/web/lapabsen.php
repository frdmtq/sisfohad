<?php
require("../../_db.php");
$smes=$_GET['semester'];
$bulan=$_GET['blnadd'];
$matkul=$_GET['matkul'];
$tipe=$_GET['tipe'];
if($tipe=="MAHASISWA")
{
$q=mysql_query("Select * from data_absen_mhs where kode_mata_kuliah='".$matkul."' and semester='".$smes."' order by tgl ASC") or die(mysql_error());
}elseif($tipe=="DOSEN")
{
	$q=mysql_query("Select * from data_absen_dosen where kode_mata_kuliah='".$matkul."' and semester='".$smes."' order by tgl ASC") or die(mysql_error());
}
$r=mysql_fetch_array($q);
$tglskrg=$r['tgl'];
$tglakhir=date("Y-m-d",strtotime($tglskrg.' + '.$bulan.' months'));
if($tipe=="MAHASISWA")
{
$result=mysql_query("SELECT data_absen_mhs.nim, mahasiswa.nama, jurusan.nama_jurusan, mata_kuliah.nama_mata_kuliah,count(data_absen_mhs.nim) as Jumlah_Hadir
FROM (((data_absen_mhs LEFT JOIN jadwal_kuliah ON data_absen_mhs.id_jadwal = jadwal_kuliah.id_jadwal) LEFT JOIN jurusan ON jadwal_kuliah.kode_jurusan = jurusan.kode_jurusan) LEFT JOIN mata_kuliah ON jadwal_kuliah.kode_mata_kuliah = mata_kuliah.kode_mata_kuliah) LEFT JOIN mahasiswa ON data_absen_mhs.nim = mahasiswa.nim Where data_absen_mhs.tgl between '".$tglskrg."' and '".$tglakhir."'");
}elseif($tipe=="DOSEN")
{
$result=mysql_query("SELECT data_absen_dosen.nid, dosen.nama, jurusan.nama_jurusan, mata_kuliah.nama_mata_kuliah,count(data_absen_dosen.nid) as Jumlah_Hadir
FROM (((data_absen_dosen LEFT JOIN jadwal_kuliah ON data_absen_dosen.id_jadwal = jadwal_kuliah.id_jadwal) LEFT JOIN jurusan ON jadwal_kuliah.kode_jurusan = jurusan.kode_jurusan) LEFT JOIN mata_kuliah ON jadwal_kuliah.kode_mata_kuliah = mata_kuliah.kode_mata_kuliah) LEFT JOIN dosen ON data_absen_dosen.nid = dosen.nid Where data_absen_dosen.tgl between '".$tglskrg."' and '".$tglakhir."'");
}

$filename="LapTengahSemester-".$smes."-".$tipe;
$file_ending = "xls";
 
header("Content-Type: application/ms-excel");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");
if($bulan=="3")
{
 print("LAPORAN ABSENSI ".$tipe." TENGAH SEMESTER ".$smes);
}else{
 print("LAPORAN ABSENSI ".$tipe." SEMESTER ".$smes);
}
		print "\n";
$sep = "\t";

 

for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}
print("\n");

 

    while($row = mysql_fetch_array($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
		
        $schema_insert = str_replace($sep."$", "", $schema_insert);
 $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
		
        print(trim($schema_insert));
        print "\n";
		
    }
?>