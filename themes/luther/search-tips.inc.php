<?php
isset($_ARCHON) or die();
if($_REQUEST['f'] == 'pdfsearch')
{
	require("pdfsearch.inc.php");
	return;
}
?>
<h1 id="titleheader">Using Nordic</h1>
<!--
<p>(Eventually, I’d like to have a video here, centered, but until we get Nordic finished and live, just this text will do)</p>
-->

<h2>More Tips and Tricks</h2>
<ul>
	<li>Entering keywords in the search box will return results from all repository locations.</li>
	<li>Having trouble finding a name? Try different spellings or try Browsing by Creator, as many Norwegian names have been changed over the years.  For example, Olsen may actually be spelled Olson.</li>
	<li>If you are only wanting to search digitized photographs, click “Digital Images” and use the keyword search box or browse all thumbnails.  This will limit your results to only digital content.</li>
	<li>Try Browsing by Repository to see the materials that are only at a specific location, such as Luther College.</li>
	<li>If you are looking for materials that are on a specific topic or format, try Browsing by Subject.  For example, you can choose to only see materials that pertain to the Vietnam War or materials that are in VHS format.</li>
</ul>
