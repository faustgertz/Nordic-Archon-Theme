<?php
/**
 * Main page for default template
 *
 * @package Archon
 * @author Chris Rishel
 */

isset($_ARCHON) or die();
switch ($_REQUEST['f']) 
{			
	case 'about':
		require('about.inc.php');
		return;
		break;
	case 'search-tips':
		require('search-tips.inc.php');
		return;
		break;	
	case 'search-tutorial':
		require('search-tutorial.inc.php');
		return;
		break;		
	case 'userlogin':
		require('userlogin.inc.php');
		return;
		break;					
	default:			
		break;										
}

echo("<h1 id='titleheader'>" . strip_tags($_ARCHON->PublicInterface->Title) . "</h1>\n");

?>
		<div id='themeindex' class='bground'>
			<p>Search the catalogs of archival materials from Norwegian-American organizations.  <a href="/?p=core/index&f=about">About the project.</a></p>
			<section class="search">
				<form action="index.php" accept-charset="UTF-8" class="group" method="get" onsubmit="if(!this.q.value) { alert('Please enter search terms.'); return false; } else { return true; }"  role="search">
					<h1><label for="qfa">Keyword Search</label></h1>
					<input name="p" type="hidden" value="core/search" />
					<input autofocus="autofocus" id="qfa" maxlength="150" name="q" size="25" title="search" type="search" value="<?php echo(encode($_ARCHON->QueryString, ENCODE_HTML)); ?>" tabindex="100" />
					<input tabindex="300" type="submit" title="Search" value="Search"" />
	<?php
	if(defined('PACKAGE_COLLECTIONS') && CONFIG_COLLECTIONS_SEARCH_BOX_LISTS)
	{
	?>
					<input name="content" type="hidden" value="1" />
	<?php
	}
	?>
				</form>	
				<p><a href="/?p=core/index&f=search-tips">How to use Nordic...</a></p>
			</section>	

		</div>
<?php /*
<div id='themeindex' class='bground'>
				<div id="searchblock">
					<form action="index.php" accept-charset="UTF-8" method="get" onsubmit="if(!this.q.value) { alert('Please enter search terms.'); return false; } else { return true; }">
						<div>
							<input type="hidden" name="p" value="core/search" />
							<input type="text" size="25" title="search" maxlength="150" name="q" id="qfa" value="<?php echo(encode($_ARCHON->QueryString, ENCODE_HTML)); ?>" tabindex="100" />
							<input type="submit" value="Search" tabindex="300" class='button' title="Search" />
<?php
if(defined('PACKAGE_COLLECTIONS') && CONFIG_COLLECTIONS_SEARCH_BOX_LISTS)
{
?>
							<input type="hidden" name="content" value="1" />
<?php
}
?>
						</div>
					</form>
				</div>
</div>
*/