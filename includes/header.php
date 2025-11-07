<?php 

	$page = basename($_SERVER['SCRIPT_NAME']);
	   
?>
<table width=100%  border="0" cellpadding="0" cellspacing="0" align="center">
  <tr align="center" valign="top"> 
    <td width="18%" >&nbsp;</td>
    <td width="76%" ><a href="<?php echo $EVENT_WEBSITE_LINK; ?>" target="_blank"><img src="<?php echo $EVENT_LOGO_LINK;?>" title="<?php echo $EVENT_NAME;?>" alt="<?php echo $EVENT_NAME;?>"  border="0" align="middle"/></a></td>
    <td width="6%">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center" valign="top">
    <td  align="center" valign="top" ></td>
    <td  align="center" valign="top" height="14" ></td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center" valign="top" bgcolor="#EEEEEE">
    <td width="35%"  align="left" valign="middle" bgcolor="#E2E2E2"  class="style2">&nbsp;</td>
    <td width="22%" height="30"  align="left" valign="middle" bgcolor="#E2E2E2"  class="style2"><?php echo $EVENT_NAME;?> <?php echo $EVENT_YEAR;?>  </td>
    <td width="43%" align="left" valign="middle" bgcolor="#E2E2E2">
    
    <?php 
	if( ($page == "download_presentations.php") || ($page == "change_pass.php") ){
    ?>
	 <table width="450" height="28" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="128" align="center" valign="middle" bgcolor="#eeeded"><strong class="style2"><a href="download_presentations.php"  class="style2" <?php if($page == "download_presentations.php"){ ?>style="color:#600;"<?php }?>>Presentations</a></strong></td>
        <td width="10" align="center" valign="middle" bgcolor="#eeeded">|</td>
        <td width="162" align="center" valign="middle" bgcolor="#eeeded"><strong class="style2"><a href="change_pass.php"  class="style2" <?php if($page == "change_pass.php"){ ?>style="color:#600;"<?php }?> >Change&nbsp;Password</a></strong></td>
        <td width="33" align="center" valign="middle" bgcolor="#eeeded">|</td>
        <td width="121" align="left" valign="middle" bgcolor="#eeeded"><strong class="style2"><a href="logout.php"  class="style2">Log&nbsp;Out</a></strong></td>
      </tr>     
    </table>
    <?php 
	}
	else
	{
	?>
     <table width="50" height="28" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td align="center" valign="middle" bgcolor="#eeeded"><strong class="style2"><a href="<?php echo $EVENT_WEBSITE_LINK; ?>" target="_blank" class="style2">Home</a></strong></td>
      </tr>
    </table>
   
	<?php 
	}
	?>
    
    
    </td>
  </tr>
</table>
