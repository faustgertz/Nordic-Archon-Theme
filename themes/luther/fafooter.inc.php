<?php
/**
 * Footer file for default theme
 *
 * @package Archon
 * @author Chris Rishel
 */

isset($_ARCHON) or die();
?>
		</div> 
	</div>

	<footer class="group" role="contentinfo">
		<nav>
			<section class="classification">
				<h1>Browse by</h1>
				<ul>
					<li class="<?php echo($TitleClass); ?>"><a href="?p=collections/collections" onclick="js_highlighttoplink(this.parentNode); return true;">Collections</a></li>
					<li class="<?php echo($DigitalLibraryClass); ?>"><a href="?p=digitallibrary/digitallibrary" onclick="js_highlighttoplink(this.parentNode); return true;">Digital Content</a></li>
					<li class="<?php echo($SubjectsClass); ?>"><a href="?p=subjects/subjects" onclick="js_highlighttoplink(this.parentNode); return true;">Subjects</a></li>
					<li class="<?php echo($CreatorsClass); ?>"><a href="?p=creators/creators" onclick="js_highlighttoplink(this.parentNode); return true;">Creators</a></li>
					<li class="<?php echo($ClassificationsClass); ?>"><a href="?p=collections/classifications" onclick="js_highlighttoplink(this.parentNode); return true;">Record Groups</a></li>
					<li><a href="/" onclick="js_highlighttoplink(this.parentNode); return true;">Keyword Search</a></li>
				</ul>
			</section>	
			<section class="account">
				<h1>Nordica</h1>
				<ul>
<?php
if(!$_ARCHON->Security->userHasAdministrativeAccess())
{
	echo("<li><a href='?p={$emailpage}&amp;f=email&amp;referer=" . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . "'>Contact Us</a></li>");
}
?>					
					<li><a href="/?p=core/index&f=about">About Us</a></li>
					<li><a href="http://www.archives.gov/nhprc/">NHPRC</a></li>
					<li><a href="http://www.luther.edu/">Luther College</a></li>
					<li><a href="http://vesterheim.org/">Vesterheim Museum</a></li>					
				</ul>
			</section>	
			<section class="account">
				<h1>
					Your Account
<?php  
/*
if($_ARCHON->Security->isAuthenticated())
{
	echo preg_replace('/^.*\)/', '', $_ARCHON->Security->Session->User->toString());	
}
*/	
?>					
				</h1>
				<ul>
<?php
if($_ARCHON->Security->isAuthenticated())
{
	$logoutURI = preg_replace('/(&|\\?)f=([\\w])*/', '', $_SERVER['REQUEST_URI']);
	$Logout = (encoding_strpos($logoutURI, '?') !== false) ? '&amp;f=logout' : '?f=logout';
	$strLogout = encode($logoutURI, ENCODE_HTML) . $Logout;
	echo($_ARCHON->Security->Session->User->toString());
	echo("<li><a href='$strLogout'>Logout</a></li>");
}
elseif($_ARCHON->config->ForceHTTPS)
{
	echo("<li><a href='index.php?p=core/login&amp;go='>Log In</li>");
	echo("<li><a href='?p=core/register'>Register</a>");
}
else
{
	echo("<li><a href='index.php?p=core/login&amp;go='>Log In</li>");
	echo("<li><a href='?p=core/register'>Register</a>");
}
?>
<?php
/*
if(!$_ARCHON->Security->userHasAdministrativeAccess())
{
*/	
	if($_ARCHON->Security->isAuthenticated())
	{
		echo("<li><a href='?p=core/account&amp;f=account'>My Account</a></li>");
	}
	if(defined('PACKAGE_COLLECTIONS'))
	{
		$_ARCHON->Security->Session->ResearchCart->getCart();
		$EntryCount = $_ARCHON->Security->Session->ResearchCart->getCartCount();
		$class = $_ARCHON->Repository->ResearchFunctionality & RESEARCH_COLLECTIONS ? '' : 'hidewhenempty';
		$hidden = ($_ARCHON->Repository->ResearchFunctionality & RESEARCH_COLLECTIONS || $EntryCount) ? '' : "style='display:none'";
		
		echo("<li><span id='viewcartlink' class='$class' $hidden><a href='?p=collections/research&amp;f=cart&amp;referer=" . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . "'>View Cart (<span id='cartcount'>$EntryCount</span>)</a></span></li>");
	}
/*
}
*/
?>				
				</ul>
			</section>													
		</nav>
		<aside>
			<p>A project made possible by partnerships with</p>
			<ul>
				<li><a href="http://www.luther.edu/"><img alt="Luther College" src="themes/<?php echo($_ARCHON->PublicInterface->Theme); ?>/_/img/logos/luther.gif" /></a></li>
				<li><a href="http://vesterheim.org/"><img alt="Vesterheim Norwegian-American Museum" src="themes/<?php echo($_ARCHON->PublicInterface->Theme); ?>/_/img/logos/vesterheim.gif" /></a></li>
				<li><a href="http://www.archives.gov/nhprc/"><img alt="National Historical Publications and Records Commission" src="themes/<?php echo($_ARCHON->PublicInterface->Theme); ?>/_/img/logos/nhprc.gif" /></a></li>
			</ul>		
		</aside>
	</footer>
	<!--[if lt IE 8]>
		<script src="<?php echo($_ARCHON->PublicInterface->ThemeJavascriptPath); ?>/ie/imgSizer.js"></script>
	<![endif]-->	