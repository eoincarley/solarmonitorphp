<?php 
	/*
	Function:
		write_footer
	
	Purpose:
			Displays footer information.
	
	Parameters:		
		Input:
			update_date -- the date of last update
		Output:
			none
	
	Author(s):
		Russ Hewett -- rhewett@vt.edu
	
	History:
		2004/07/13 (RH) -- written
	*/
	
	function write_footer($update_date)
	{
		
		
		//	start the display
		print("<table width=850 >\n");

		print("	<tr>\n");

		print("		<td align=\"left\"><font size=\"-1\">\n");


		print(" &nbsp\n");
		
		print(" <hr size=1>\n");

		// 	print("<div  id=\"footer\">\n");
				print("<table width=100% align=\"justify\" border=\"0\">\n");
				print("	<tr>\n");
					print("  <td align=\"justify\"><font color=white>\n");
						print(" <a href=\"http://www.tcd.ie/\"><img src=\"./common_files/images/logos/TCD-logo-wide-new.png\" align=left border=0 height=65></a>\n");
						print("<a href=\"http://www.dias.ie//\"><img src=\"./common_files/images/logos/dias_logo2.jpg\" align=left border=0 height=65></a>\n");
									
						//print("  <td align=\"left\">\n");
						print("		<a class=info href=\"./about.php\" color=white> &nbsp About</a><br>\n");
						print("     <a class=info href=\"./help.php\"> &nbsp  Help</a><br> \n");
						print("		<a class=info href=\"./contact.php\"> &nbsp Contact</a><br>\n");
						//print("	 </td>\n");
						//print("  <td align=\"left\">\n");
						// print("     <a class=info href=\"./news.php\">&nbsp News</a><br> \n");
						//		print("     <a class=info href=\"./jobs.php\">jobs</a><br> \n");
						print("  &nbsp    <a class=info href=\"./rss.php\"><img src=\"./common_files/images/rssfeed.jpg\" width=12> rss feed</a>\n");
						//print("	 </td>\n");
						//print("  <td align=\"right\">\n");

					print("	 </td>\n");


				print(" </tr>\n");
				print("</table>\n");




		print(" <hr size=1>\n");

	
		//	print("</div>\n");

		print("			</td>\n");	
		print("			</tr>\n");
		print("		</table>\n");


	}
	
?>