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
	
	function write_footer_js()
		{
			print("	<script type='text/javascript' src='./common_files/js/jquery.hoverIntent.minified.js'></script>\n");
			print("	<script type='text/javascript'>\n");
			print("	$(document).ready(function() {\n");
			print("		//On Hover Over\n");
			print("function megaHoverOver(){\n");
			print("    $(this).find(\".sub\").stop().fadeTo('fast', 1).show(); //Find sub and fade it in\n");
			print("    (function($) {\n");
			print("        //Function to calculate total width of all ul's\n");
			print("        jQuery.fn.calcSubWidth = function() {\n");
			print("            rowWidth = 0;\n");
			print("            //Calculate row\n");
			print("            $(this).find(\"ul\").each(function() { //for each ul...\n");
			print("                rowWidth += $(this).width(); //Add each ul's width together\n");
			print("            });\n");
			print("        };\n");
			print("    })(jQuery); \n");
			print("\n");
			print("    if ( $(this).find(\".row\").length > 0 ) { //If row exists...\n");
			print("\n");
			print("        var biggestRow = 0;	\n");
			print("\n");
			print("        $(this).find(\".row\").each(function() {	//for each row...\n");
			print("            $(this).calcSubWidth(); //Call function to calculate width of all ul's\n");
			print("            //Find biggest row\n");
			print("            if(rowWidth > biggestRow) {\n");
			print("                biggestRow = rowWidth;\n");
			print("            }\n");
			print("        });\n");
			print("\n");
			print("        $(this).find(\".sub\").css({'width' :biggestRow}); //Set width\n");
			print("        $(this).find(\".row:last\").css({'margin':'0'});  //Kill last row's margin\n");
			print("\n");
			print("    } else { //If row does not exist...\n");
			print("\n");
			print("        $(this).calcSubWidth();  //Call function to calculate width of all ul's\n");
			print("        $(this).find(\".sub\").css({'width' : rowWidth}); //Set Width\n");
			print("\n");
			print("    }\n");
			print("}\n");
			print("//On Hover Out\n");
			print("function megaHoverOut(){\n");
			print("  $(this).find(\".sub\").stop().fadeTo('fast', 0, function() { //Fade to 0 opactiy\n");
			print("      $(this).hide();  //after fading, hide it\n");
			print("  });\n");
			print("}\n");
			print("//Set custom configurations\n");
			print("var config = {\n");
			print("     sensitivity: 2, // number = sensitivity threshold (must be 1 or higher)\n");
			print("     interval: 100, // number = milliseconds for onMouseOver polling interval\n");
			print("     over: megaHoverOver, // function = onMouseOver callback (REQUIRED)\n");
			print("     timeout: 500, // number = milliseconds delay before onMouseOut\n");
			print("    out: megaHoverOut // function = onMouseOut callback (REQUIRED)\n");
			print("};\n");
			print("$(\"ul#toolnav li .sub\").css({'opacity':'0'}); //Fade sub nav to 0 opacity on default\n");
			print("$(\"ul#toolnav li\").hoverIntent(config); //Trigger Hover intent with custom configurations\n");
			print("});\n");
			print("	</script>\n");
		}
	
?>