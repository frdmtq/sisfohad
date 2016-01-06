<?php
ob_start();

	$rs=mysql_query("Select * from config");
	$row=mysql_fetch_array($rs);
?>
<form name="form1" method="post">
  <table width="50%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="36%">Limit Absen</td>
      <td width="64%">
      <input type="text" name="cfg1" id="cfg1" value="<?php echo $row['limit_absen']; ?>"></td>
    </tr>
    
    
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" class="btn btn-primary" name="button" id="button" value="Ubah"></td>
    </tr>
  </table>
</form>

<?php
if(isset($_POST['button']))
{
	
	$rs=mysql_query("Update config SET limit_absen='".$_POST['cfg1']."'") or die(mysql_error());
	if($rs)
	{
		echo "<script>alert('Berhasil diubah')</script>";
	}
}
?>
<?php
ob_end_flush();
?>
