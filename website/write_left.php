<?
	/*
	Function:
		write_left
	
	Purpose:
			Displays left navigation links.
	
	Parameters:		
		Input:
			date -- the date in YYYYMMDD format for which to display from
		Output:
			none
	
	Author(s):
		Russ Hewett -- rhewettvt.edu
	
	History:
		2004/07/13 (RH) -- written
	*/
	
	function write_left($date, $current_region_number)
	{
		include ("globals.php");
		
		$file_ar = "${arm_data_path}data/" . $dirdate . "/meta/arm_ar_summary_" . $date. ".txt";
		$files_charm=glob("${arm_data_path}data/charm/charm_".$date."_????_chgrp.csv")?glob("${arm_data_path}data/charm/charm_".$date."_????_chgrp.csv"):array();
		$smart_path = (strtotime($date) > strtotime($date_smart_hmi))?"smart_hmi_output/":"${arm_data_path}data/smart/";
			$smart_hour = (strtotime($date) > strtotime($date_smart_hmi))?"??????":"????";
			$files_smart=glob("${smart_path}smart_ascii/smart_".$date."_${smart_hour}_ar.txt")?glob("${smart_path}smart_ascii/smart_".$date."_${smart_hour}_ar.txt"):array();
		
		print("<table width=70>\n");
		print("	<tr>\n");
		print("		<td align=center valign=top>\n");
		print("			<br><font color=white><b>SOHO</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenSoho(\"./soho_pop.php?date=$date&type=eit195\")>Movies</a><br>\n");
		print("			<b><font color=\"white\"><br>NOAA </font><br><font color=\"white\" size=\"-1\"> Active Regions</font></b>\n");
		print("			<br>\n");
		
		if (file_exists($file_ar))
		{
			//	Read the entire contents of the file in to the lines array
			$lines = file($file_ar);
			foreach ($lines as $line)
			{
				//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be split later.
				list($number, $location1, $location2, $hale, $mcintosh, $area, $nspots, $events ) = split('[ ]', $line, 8);
				if ($current_region_number == $number)
					print("			<b><font color=\"white\" size=\"-1\"><a class=mail href=\"region.php?date=$date&region=$number\">$number</a></font></b>\n");//<a href=\"./region.php?date=$date&region=$number\">$number</a></b></font>\n");
				else
					print("			<font color=\"white\" size=\"-1\"><a class=mail href=\"region.php?date=$date&region=$number\">$number</a></font>\n");				
			} 
		}
		else
		{
			//	If there is no data file, display a warning message
			print("				<font color=\"white\" size=\"-1\">No Data</font>\n");
		}
		
		//if ($current_region_number == -1) 
			print("			\n");
			print("		<input type=\"text\" value=\"\" name=\"region_number\" size=5 maxlength=5>		\n");

			print("			\n");
		print(" <br>\n");
				
		print("			<b><font color=\"white\"><br>SMART</font><br><font color=\"white\" size=\"-1\">Active Regions<br></font></b>\n");
		if (count($files_smart) !== 0)
		{
			$files_smart = array_reverse($files_smart);
			$file_smart = $files_smart[0];
			$lines = file($file_smart);
			$ars = count($lines) - 11;
			$detect = ($ars > 1)?' detections':' detection';
			print("<font color=\"white\" size=\"-1\"> <a class=mail href=\"smart_disk.php?date=$date\">".$ars.$detect."</a></font>\n");
		}
		else
		{
			//	If there is no data file, display a warning message
			print("<font color=\"white\" size=\"-1\">No detections</font>\n");
		}
		print("<br>\n");
		
		
		
		print("			<b><font color=\"white\"><br>CHARM</font><br><font color=\"white\" size=\"-1\">Coronal Holes<br></font></b>\n");
		if (count($files_charm) !== 0)
		{
			$files_charm = array_reverse($files_charm);
			$file_charm = $files_charm[0];
			$lines = file($file_charm);
			$chs = count($lines) - 1;
			$detect = ($chs > 1)?' detections':' detection';
			print("<font color=\"white\" size=\"-1\"><a class=mail href=\"charm_disk.php?date=$date\">".$chs.$detect."</a></font>\n");
		}
		else
		{
			//	If there is no data file, display a warning message
			print("<font color=\"white\" size=\"-1\">No detections</font>\n");
		}
		print("<br>\n");
		
		print("			<a class=mail href=\"./search.php?date=$date\">Search</a><br>\n");
		print("         <a class=mail href=\"./news.php\">News</a><br>\n");
		print("         <a class=mail href=\"./credits.php\">Credits</a><br><br>\n");
		print("			<font color=white><b>GOES</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=xray\")>X-rays</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=proton\")>Protons</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=electron\")>Electrons</a><br><br>\n");
		print("			<font color=white><b>ACE</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenAce(\"./ace_pop.php?date=$date&type=aceplasma\")>Plasma</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenAce(\"./ace_pop.php?date=$date&type=acemag\")>B Field</a><br><br>\n");
		print("			<font color=white><b>SDO/EVE</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenEve(\"./eve_pop.php?date=$date&type=eve3day\")>3 Day</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenEve(\"./eve_pop.php?date=$date&type=eve6hr\")>6 Hour</a><br><br>\n");
//		print("			<font color=white><b>SOHO</b></font><br>\n");
//		print("			<a class=mail href=JavaScript:OpenSoho(\"./soho_pop.php?date=$date&type=eit195\")>Movies</a><br><br>\n");
/*		print("			<font color=white><b>RHESSI</b></font><br>\n");
		print("			<a href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=rhessi\")>Times</a><br><br>\n");
*/
		
		//	print("			<font color=white><b>Geomag</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenAurora(\"./aurora_pop.php?date=$date&type=geddsnowcast\")>Now-cast</a><br><br>\n");
		
		
		print("			<font color=white><b>Events</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenHek(\"$heklink\")>HEK</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenLastEvents(\"http://www.lmsal.com/solarsoft/last_events/\")>SolarSoft</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenEvents()>SWPC</a><br><br>\n");
		print("			<font color=white><b>MM</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenMotD(\"./motd_pop.php?date=$date\")>MotD</a><br><br>\n");
//		print("			<br><font color=white><b>BBSO</b></font><br>\n");
//		print("			<a href=JavaScript:TermWindow()>Activity<br>Report</a><br>\n");
		print("			<font color=white><b>IDL</b></font><br>\n");
		print("         <a class=mail target=_blank href=\"./objects/solmon/\">SOLMON Object</a><br><br>\n");
		
		//if ($current_region_number == -1) 
		print("			\n");

		print("		</td>\n");
		
		
		print("	</tr>\n");
		/*print("	<tr>\n");
		print("		<td align=center valign=bottom>\n");
		print("			<a href=JavaScript:TermWindow()>BBSO<br>Activity<br>Report<br><br></a>\n");
		print("		</td>\n");
		print("	</tr>\n");*/
		print("</table>\n");
	}

		function write_left_clean()
		{
		print("<table width=70 border=0>\n");
		print(" </table>\n");
			
		}
	
		function write_left_accordion($date, $current_region_number)
		{
		  
		  include ("globals.php");
			$file_ar = "${arm_data_path}data/" . $dirdate . "/meta/arm_ar_summary_" . $date. ".txt";
			$files_charm=glob("${arm_data_path}data/charm/charm_".$date."_????_chgrp.csv")?glob("${arm_data_path}data/charm/charm_".$date."_????_chgrp.csv"):array();
			$smart_path = (strtotime($date) > strtotime($date_smart_hmi))?"smart_hmi_output/":"${arm_data_path}data/smart/";
			$smart_hour = (strtotime($date) > strtotime($date_smart_hmi))?"??????":"????";
			$files_smart=glob("${smart_path}smart_ascii/smart_".$date."_${smart_hour}_ar.txt")?glob("${smart_path}smart_ascii/smart_".$date."_${smart_hour}_ar.txt"):array();
		print("<table width=70 border=0>\n");
		print("   <tr>\n");
		print("		<td align=center valign=top height=\"460px\">\n");
		//		print("		  <br><div class=\"right\">\n");
		//print("			<div class=\"header2\">SoHO</div>");
		//print("         <a class=mail href=JavaScript:OpenSoho(\"./soho_pop.php?date=$date&type=eit195\")>Movies</a><br>\n");
		//print("		  </div>\n");
		print("<br>\n");
		print("        <div id=\"sliderl\">\n");

		print("          <div class=\"header\" id=\"NOAA-head\">NOAA</div>\n");
		// NOAA ARs INPUT
		if (file_exists($file_ar))
		{
			//	Read the entire contents of the file in to the lines array
			$lines = file($file_ar);
			$noaa_ars = count($lines);
			$noaa_str = ($noaa_ars != 1)?' Active Regions':' Active Region';
			print("      <div class=\"header_sm\" id=\"NOAA-header\">$noaa_ars$noaa_str</div>\n");
			print("      <div class=\"content\" id=\"NOAA-content\">		\n");
			print("          <div class=\"text\">\n");
			foreach ($lines as $line)
			{
				//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be split later.
				list($number, $location1, $location2, $hale, $mcintosh, $area, $nspots, $events ) = split('[ ]', $line, 8);
				print("      		<a class=mail href=\"index.php?date=$date&region=$number\">$number</a><br>\n");
			} 
			print("          </div>\n");
			print("        </div>\n");
		}
		else
		{
			//	If there is no data file, display a warning message
			print("          <div class=\"header_sm\" id=\"NOAA-header\">Active Regions <br> No Data</div>\n");
		}

		// write the AR form
		
		print("			\n");
		print("     <br>\n");
		
		print("          <div class=\"header\" id=\"Sol-header\">Flare Forecast</div>\n");
  		print("		 <div class=\"content\" id=\"Sol-content\">\n");
		print("			   <div class=\"text\">\n");
		
		
		if (strtotime($date) >= strtotime("20150830"))
			 {  
				print("                         <a class=mail href=\"./forecast.php?date=$date\">Flare Prediction System</a><br>\n");
			  } else
			 {   
			        print("                         <a class=mail href=\"./forecast_no_fps.php?date=$date\">Flare Forecast</a><br>\n");

	                  } 
		
		print("	           		<a class=mail href=JavaScript:OpenMotD(\"./motd_pop.php?date=$date\")>MM MotD</a>\n");
		print("			   </div>\n");
		print("  	</div>\n");

		
		print("		  </div>\n");

		print("        <br><div id=\"sliderr\">\n");
		//TODO: On mouse over! : http://www.java2s.com/Code/JavaScript/jQuery/jQueryUIAccordionOpenonmouseover.htm
		print("          <div class=\"header\" id=\"GOES-header\" onmouseover>GOES</div>\n");
		print("          <div class=\"content\" id=\"GOES-content\">		\n");
		print("          <div class=\"text\">\n");
		print("      		<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=xray\")>X-rays</a><br>\n");
		print("				<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=proton\")>Protons</a><br>\n");
		print("				<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=electron\")>Electrons</a>\n");
		print("     	</div>\n");
		print("  		</div>\n");
		print("  		<div class=\"header\" id=\"ACE-header\">ACE</div>\n");
		print("  		<div class=\"content\" id=\"ACE-content\">\n");
    	print("	 		<div class=\"text\">\n");
		print("				<a class=mail href=JavaScript:OpenAce(\"./ace_pop.php?date=$date&type=aceplasma\")>Plasma</a><br>\n");
		print("				<a class=mail href=JavaScript:OpenAce(\"./ace_pop.php?date=$date&type=acemag\")>B Field</a>\n");
    	print("			</div>\n");
		print(" 		</div>\n");
		print("  		<div class=\"header\" id=\"EVE-header\">SDO/EVE</div>\n");
		print(" 		<div class=\"content\" id=\"EVE-content\">\n");
		print(" 	   	<div class=\"text\">\n");
		print("    			<a class=mail href=JavaScript:OpenEve(\"./eve_pop.php?date=$date&type=eve3day\")>3 Day</a><br>\n");
		print("				<a class=mail href=JavaScript:OpenEve(\"./eve_pop.php?date=$date&type=eve6hr\")>6 Hour</a>\n");
		print("   		</div>\n");
		print("  		</div>\n");
		//	print(" 		<div class=\"header\"><a class=mail5 href=JavaScript:OpenAurora(\"./aurora_pop.php?date=$date&type=geddsnowcast\")>GeoMag</a></div>\n");
		//print("		    <div class=\"content\" id=\"GEOMAG-content\">\n");
		//print(" 	   	<div class=\"text\">\n");
		//print("    			<a class=mail href=JavaScript:OpenAurora(\"./aurora_pop.php?date=$date&type=geddsnowcast\")>Now-cast</a>\n");
		//print("			</div>\n");
		//print("			</div>\n");
		print("  		<div class=\"header\" id=\"Events-header\">Events</div>\n");
  		print("			<div class=\"content\" id=\"Events-content\">\n");
		print("			<div class=\"text\">\n");
		print("				<a class=mail href=JavaScript:OpenLastEvents(\"http://www.lmsal.com/solarsoft/last_events/\")>SolarSoft</a><br>\n");
		print("				<a class=mail href=JavaScript:OpenEvents()>SWPC</a>\n");
		print("				<a class=mail href=JavaScript:OpenHek(\"$heklink\")>HEK</a><br>\n");
		print("			</div>\n");
  		print("			</div>\n");
		//	print("          <div class=\"header\" id=\"Forecast-header\">Forecast</div>\n");
		//	print("		 <div class=\"content\" id=\"Forecast-content\">\n");
		//	print("			   <div class=\"text\">\n");
		//	print("				<a class=mail href=\"./forecast.php?date=$date\">Flare Forecast</a><br>\n");
		//	print("	           		<a class=mail href=JavaScript:OpenMotD(\"./motd_pop.php?date=$date\")>MM MotD</a>\n");
		//	print("			   </div>\n");
		//	print("  	</div>\n");

		print("		  </div>\n");		
		

		print("		</td>\n");
		print("	</tr>\n");
		

		print(" <tr height=auto>\n");
		print(" <td  align=center valign=bottom>\n");
		print("        <div id=\"sliderl2\">\n");


		//print("<br>\n");
		
		


		// SMART INPUT
		//	print("          <div class=\"header\" id=\"SMART-head\" onmouseover=\"title='Active Regions'\">SMART</div>\n");
		
		print("      <div class=\"content\" id=\"SMART-content\">		\n");
		print("</div>\n");
		
		//print("<br>\n");


		// CHARM INPUT
		//	print("          <div class=\"header\" id=\"CHARM-head\" onmouseover=\"title='Coronal Holes'\">CHARM</div>\n");
		print("      <div class=\"content\" id=\"CHARM-content\">		\n");
		print("</div>\n");

		print("		  </div>\n");


		if (count($files_smart) !== 0)
		{
			$files_smart = array_reverse($files_smart);
			$file_smart = $files_smart[0];
			$lines = file($file_smart);
			$ars = count($lines) - 1;
			$detect = ($ars > 1)?' detections':' detection';
			print("          <div class=\"header_sm\" id=\"SMART-header\"><a class=mail href=\"smart_disk.php?date=$date\">".$ars.$detect."</a></div>\n");
		}
		else
		{
			//	If there is no data file, display a warning message
		  //		print("          <div class=\"header_sm\" id=\"SMART-header\">No Data</div>\n");
		}


		if (count($files_charm) !== 0)
		{
			$files_charm = array_reverse($files_charm);
			$file_charm = $files_charm[0];
			$lines = file($file_charm);
			$chs = count($lines) - 1;
			$detect = ($chs > 1)?' detections':' detection';
			print("          <div class=\"header_sm\" id=\"CHARM-header\"><a class=mail href=\"charm_disk.php?date=$date\">".$chs.$detect."</a></div>\n");
		}
		else
		{
			//	If there is no data file, display a warning message
		  //		print("          <div class=\"header_sm\" id=\"CHARM-header\">No Data</div>\n");
		}


		print("		</td>\n");
		print("	</tr>\n");
		print("</table>\n");
		}	
?>
