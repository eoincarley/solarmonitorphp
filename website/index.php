<?
	include("include.php");
	include("globals.php");
	$title = "www.SolarMonitor.org";
	$indexnum = "1";
?>

<html>

	<? write_header($date, $title, $this_page) ?>
	<body  color="black" onload="slider.init('sliderl');slider.init('sliderl2');slider.init('sliderr');warning.init('warning')">
	  <? require("common_files/themes.php"); ?>
		<center>
			<table width=842 border=0 cellpadding=0 cellspacing=0 align=center color=#333333>
				<tbody>
				
				<tr>
					<td align=right colspan=3>
						<? write_title_cal1($date, $title, $this_page, $indexnum); ?>
					</td>
				</tr>
			

				<tr>
					
					<td valign=top align=left width=82>
						<? write_left_accordion($date,-1); ?>

					</td>
					<td bgcolor=#383838 valign=top align=center width=100%>
					    <? if ($region == '') 
						{
						  write_index_body_slider($date, $indexnum,"fd");
						} 
					       else 
						{
						  write_index_body_slider($date, $indexnum, "ar",$region);
					        }
					    ?>
					</td>
					<td valign=top align=left width=82>
						<? write_right_accordion($date,-1); ?>

					</td>
				
				</tr>
				

				<tr>
					<td align=center colspan=4>
						<? write_bottom_clean(); ?>
					
						&nbsp

					</td>
				</tr>

				</tbody>
			</table>
	
	
 			<? write_new_ar_table($date); ?>

			<? write_events($date); ?>
		
		
			<td>
				<?php write_footer($time_updated); ?>		
			</td>
			</center>
			
	</body>
</html>
