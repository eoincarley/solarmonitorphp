<?
	/*
	Function:
		write_ar_table
	
	Purpose:
			Displays the 'Today's NOAA Active Regions' table for ARM.  If 
		./data/DATE/meta/ar_table.txt does not exist, that is noted on the page.
	
	Parameters:		
		Input:
			date -- the date in YYYYMMDD format for which to display from
		Output:
			none
	
	Author(s):
		Russ Hewett -- rhewett@vt.edu
	
	History:
		2004/07/12 (RH) -- written
		2004/07/15 (RH) -- added events linking
	*/
	
	function write_ar_table($date)
	{	
	include ("globals.php");
		
		//	Contruct the file name
		$file = "${arm_data_path}data/" . $dirdate . "/meta/arm_ar_summary_" . $date . ".txt";

			print("<div class=noaat>\n");		
			print("<table class='frame' rules=rows width=700 align=center cellpadding=0 cellspacing=0>\n");
			print("	  <tr align=center class=noaatit>\n");
			print("         <td colspan=7> Today's NOAA Active Regions</td>\n");
			print("   </tr>\n");
			print("   <tr border=0 align=center class=noaacolumns>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='This is a unique number assigned to each new active region by NOAA.'\">Number</div></i></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='The locations are given in heliographic (latitude and longitude) and heliocentric (arcseconds from Sun centre).'\">Location</a></div></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='The Hale class describes the magnetic complexity of an active region'\">Hale Class</div></i></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='The McIntosh class describes the complexity of the sunspot group'\">McIntosh Class</div></i></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='The area in millionths of the solar disk area.'\">Area</div></i></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='Number of the Spots that form the active region'\">Number of Spots</div></i></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='Number of Flares associated with the active region.'\">Flares</div></i></td>\n");
			print("   </tr>\n");
		
		//	Print the start of the table and the column headers.  These always display.
//TODO: this if should go before the header or make a change to say that there is not ARs			
		if (file_exists($file))
		{
			//	Read the entire contents of the file in to the lines array
			$lines = file($file);
			foreach ($lines as $line)
			{
				//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be split later.
				list($number, $location1, $location2, $hale, $mcintosh, $area, $nspots, $events ) = split('[ ]', $line, 8);
				
				//	Split the Hale text in to individual characters.  For each part go through each character and 
				//	build a string with the image tags for each of the greek letters.
				list($hale1,$hale2) = split('[/]', $hale,2);
				$hale1_arr = preg_split('//', $hale1, -1, PREG_SPLIT_NO_EMPTY);
				$hale2_arr = preg_split('//', $hale2, -1, PREG_SPLIT_NO_EMPTY);
				
				$hale1_str = "";
				$hale2_str = "";
				
				foreach($hale1_arr as $elem)
				{
					switch($elem)
					{
						case 'a':
							//$hale1_str = $hale1_str . "<img src=\"./common_files/alpha.jpg\">";
							$hale1_str = $hale1_str . "&alpha;";
							break;
						case 'b':
							//$hale1_str = $hale1_str . "<img src=\"./common_files/beta.jpg\">";
							$hale1_str = $hale1_str . "&beta;";
							break;
						case 'g':
							//$hale1_str = $hale1_str . "<img src=\"./common_files/gamma.jpg\">";
							$hale1_str = $hale1_str . "&gamma;";
							break;
						case 'd':
							//$hale1_str = $hale1_str . "<img src=\"./common_files/delta.jpg\">";
							$hale1_str = $hale1_str . "&delta;";
							break;
						case '-':
							$hale1_str = $hale1_str . "-";
							break;	
					}
				}
				
				foreach($hale2_arr as $elem)
				{
					switch($elem)
					{
						case 'a':
							//$hale2_str = $hale2_str . "<img src=\"./common_files/alpha.jpg\">";
							$hale2_str = $hale2_str . "&alpha;";
							break;
						case 'b':
							//$hale2_str = $hale2_str . "<img src=\"./common_files/beta.jpg\">";
							$hale2_str = $hale2_str . "&beta;";
							break;
						case 'g':
							//$hale2_str = $hale2_str . "<img src=\"./common_files/gamma.jpg\">";
							$hale2_str = $hale2_str . "&gamma;";
							break;
						case 'd':
							//$hale2_str = $hale2_str . "<img src=\"./common_files/delta.jpg\">";
							$hale2_str = $hale2_str . "&delta;";
							break;
						case '-':
							$hale2_str = $hale2_str . "-";
							break;	
					}
				}
				
				//	this section works similar to the write_events function.
				//	first, start with a blank events string, then split all the parts of the events up into an array.
				//	loop through the array.
				$events_str="";
				if ($events[0] != "-")
				{
					$events_arr = split('[ ]', $events);
					for($i=0; $i<count($events_arr); $i++)
					{
						//	if there is a slash, add it to the string.  otherwise, get the url and the data that follows
						//	one array index behind.  incriment the array counter.  add the correct hyperlink to the string.
						if ($events_arr[$i] == "/")
						{
							$events_str = $events_str . "/";
						}
						else
						{
							$url = $events_arr[$i];
							$data = $events_arr[$i+1];
							$i++;
							$events_str = $events_str . "<a class=mail2 href=javascript:OpenLastEvents(\"$url\")>$data</a><br>";
						}
					}
				}
				else
				{
					$events_str = "-";
				}
				
				//	Finally print all of the columns.  $events still needs to be parsed and implemented.

					//	Print the columns with their identifiers
					print("<tr class=noaaresults align=center>\n");
					print("  <td   id=\"noaa_number\" bgcolor=#f0f0f0>    <a class=mail2 href=\"index.php?date=$date&region=$number\">$number</a></td>\n");
					print("  <td   id=\"position\"    bgcolor=#f0f0f0>       $location1<br>$location2   </td>\n");
					print("  <td   id=\"hale\"        bgcolor=#f0f0f0>           $hale1_str/$hale2_str      </td>\n");
					print("  <td   id=\"mcintosh\"    bgcolor=#f0f0f0>       $mcintosh                  </td>\n");
					print("  <td   id=\"area\"        bgcolor=#f0f0f0>           $area                      </td>\n");
					print("  <td   id=\"nspots\"      bgcolor=#f0f0f0>         $nspots                    </td>\n");
					print("  <td   id=\"events\"      bgcolor=#f0f0f0>         $events_str                </td>\n");
					print("</tr>\n");

			}
		}
		else
		{
			//	If there is no data file, display a warning message
			print("	<tr align=center>\n");
			print("		<td colspan=7 align=\"center\" bgcolor=\"#f0f0f0\"><font color=\"#000000\">\n");
			print("			<i>No Data Available For This Day</i>\n");
			print("		</td></font>\n");
			print("	</tr>\n");
		}	
		
		//	Close off the table
		print("</table>\n");
		print("</div>\n");			
	}
?>