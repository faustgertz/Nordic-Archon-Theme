<?php
/**
 * Header file for default theme
 *
 * @package Archon
 * @author Paul Sorensen, originally adapted from "default" by Chris Rishel, Chris Prom, Kyle Fox
 */
isset($_ARCHON) or die();

// *** This is now a configuration directive. Please set in the Configuration Manager ***
//$_ARCHON->PublicInterface->EscapeXML = false;


if($_ARCHON->Script == 'packages/collections/pub/findingaid.php')
{
   require("faheader.inc.php");
   return;
}

$_ARCHON->PublicInterface->Header->OnLoad .= "externalLinks();";

if($_ARCHON->Error)
{
   $_ARCHON->PublicInterface->Header->OnLoad .= " alert('" . encode(str_replace(';', "\n", $_ARCHON->processPhrase($_ARCHON->Error)), ENCODE_JAVASCRIPT) . "');";
}

if(defined('PACKAGE_COLLECTIONS'))
{

   if($objCollection->Repository)
   {
      $RepositoryName = $objCollection->Repository->getString('Name');
   }
   elseif($objDigitalContent->Collection->Repository)
   {
      $RepositoryName = $objDigitalContent->Collection->Repository->getString('Name');
   }
   else
   {
      $RepositoryName = $_ARCHON->Repository ? $_ARCHON->Repository->getString('Name') : '';
   }

   $_ARCHON->PublicInterface->Title = $_ARCHON->PublicInterface->Title ? $_ARCHON->PublicInterface->Title . ' | ' . $RepositoryName : $RepositoryName;

   if($_ARCHON->QueryString && $_ARCHON->Script == 'packages/core/pub/search.php')
   {
      $_ARCHON->PublicInterface->addNavigation("Search Results For \"" . $_ARCHON->getString(QueryString) . "\"", "?p=core/search&amp;q=" . $_ARCHON->QueryStringURL, true);
   }
}
else
{
   $RepositoryName = $_ARCHON->Repository ? $_ARCHON->Repository->getString('Name') : 'Archon';

   $_ARCHON->PublicInterface->Title = $_ARCHON->PublicInterface->Title ? $_ARCHON->PublicInterface->Title . ' | ' . $RepositoryName : $RepositoryName;

   if($_ARCHON->QueryString)
   {
      $_ARCHON->PublicInterface->addNavigation("Search Results For \"" . encode($_ARCHON->QueryString, ENCODE_HTML) . "\"", "?p=core/search&amp;q=" . $_ARCHON->QueryStringURL, true);
   }
}

$_ARCHON->PublicInterface->addNavigation('Archon', 'index.php', true);

//header('Content-type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>  
<!--[if lt IE 7 ]><html class="no-js ie6" id="archon-luther-edu" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" id="archon-luther-edu" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" id="archon-luther-edu" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="no-js ie9" id="archon-luther-edu" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js" id="archon-luther-edu" lang="en"><!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title><?php echo(strip_tags($_ARCHON->PublicInterface->Title)); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="themes/<?php echo($_ARCHON->PublicInterface->Theme); ?>/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="themes/<?php echo($_ARCHON->PublicInterface->Theme); ?>/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo($_ARCHON->PublicInterface->ThemeJavascriptPath); ?>/cluetip/jquery.cluetip.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo($_ARCHON->PublicInterface->ThemeJavascriptPath); ?>/jgrowl/jquery.jgrowl.css" />
		
		<link rel="icon" type="image/ico" href="<?php echo($_ARCHON->PublicInterface->ImagePath); ?>/favicon.ico"/>
		<!--[if lte IE 7]>
			<link rel="stylesheet" type="text/css" href="themes/<?php echo($_ARCHON->PublicInterface->Theme); ?>/ie.css" />
			<link rel="stylesheet" type="text/css" href="themes/<?php echo($_ARCHON->PublicInterface->ThemeJavascriptPath); ?>/cluetip/jquery.cluetip.ie.css" />
		<![endif]-->
		<?php echo($_ARCHON->getJavascriptTags('jquery.min')); ?>
		<?php echo($_ARCHON->getJavascriptTags('jquery-ui.custom.min')); ?>
		<?php echo($_ARCHON->getJavascriptTags('jquery-expander')); ?>
		<script src="<?php echo($_ARCHON->PublicInterface->ThemeJavascriptPath); ?>/jquery.hoverIntent.js"></script>
		<script src="<?php echo($_ARCHON->PublicInterface->ThemeJavascriptPath); ?>/cluetip/jquery.cluetip.js"></script>
		<script src="<?php echo($_ARCHON->PublicInterface->ThemeJavascriptPath); ?>/jquery.scrollTo-min.js"></script>
		<script src="<?php echo($_ARCHON->PublicInterface->ThemeJavascriptPath); ?>/functions.js"></script>
		<?php echo($_ARCHON->getJavascriptTags('jquery.jgrowl.min')); ?>
		<?php echo($_ARCHON->getJavascriptTags('archon')); ?>
		
		<script>
		/* <![CDATA[ */
			imagePath = '<?php echo($_ARCHON->PublicInterface->ImagePath); ?>';
			$(document).ready(function() {
				$('div.listitem:nth-child(even)').addClass('evenlistitem');
				$('div.listitem:last-child').addClass('lastlistitem');
				$('#locationtable tr:nth-child(odd)').addClass('oddtablerow');
				$('.expandable').expander({
					slicePoint:       600,              // make expandable if over this x chars
					widow:            100,              // do not make expandable unless total length > slicePoint + widow
					expandText:       '[read more]',  //text to use for expand link
					expandEffect:     'fadeIn',         // or slideDown
					expandSpeed:      700,              // in milliseconds
					collapseTimer:    0,                // milliseconds before auto collapse; default is 0 (don't re-collape)
					userCollapseText: '[collapse]'      // text for collaspe link
				});
			});
			
			function js_highlighttoplink(selectedSpan)
			{
				$('.currentBrowseLink').toggleClass('browseLink').toggleClass('currentBrowseLink');
				$(selectedSpan).toggleClass('currentBrowseLink');
				$(selectedSpan).effect('highlight', {}, 300);
			}
			
			$(document).ready(function() {<?php echo($_ARCHON->PublicInterface->Header->OnLoad); ?>});
			$(window).unload(function() {<?php echo($_ARCHON->PublicInterface->Header->OnUnload); ?>});
			$(document).ready(function() {
<?php if (empty($_SERVER['QUERY_STRING'])) { ?>
		(function($) {
			var $search = $('section.search');
			if ($search.length > 1)
			{
				$search.eq(0).remove();
			}
		})(jQuery);
<?php	} ?>
		});			
		/* ]]> */
		</script>
<?php
if($_ARCHON->PublicInterface->Header->Message && $_ARCHON->PublicInterface->Header->Message != $_ARCHON->Error)
{
	$message = $_ARCHON->PublicInterface->Header->Message;
}
?>
		<script src="<?php echo($_ARCHON->PublicInterface->ThemeJavascriptPath); ?>/modernizr/modernizr-2.0.6.js"></script>
		<!--[if lt IE 9]>
			<script src="<?php echo($_ARCHON->PublicInterface->ThemeJavascriptPath); ?>/ie/html5.js"></script>
		<![endif]-->	
	</head>
	<body>
<?php
$_ARCHON->PublicInterface->outputGoogleAnalyticsCode();

if($message)
{
	echo("<div class='message' role='alert'>" . encode($message, ENCODE_HTML) . "</div>\n");
}
?>

	<header class="group" role="banner">

		<h1 id="logo"><a href="index.php" ><img src="<?php echo($_ARCHON->PublicInterface->ImagePath); ?>/logo.png" alt="logo" /></a></h1>

		<nav>
			<section id="researchblock">
				<h1>Research</h1>
				<div class="container">
					<ul class="group">
<?php
if($_ARCHON->Security->isAuthenticated())
{
	if($_ARCHON->Security->userHasAdministrativeAccess())
	{
		echo("<li>Welcome, " . $_ARCHON->Security->Session->User->toString() . "</li>");
	}	
	if($_ARCHON->Security->userHasAdministrativeAccess())
    {
    	echo("<li><a href='?p=admin' rel='external'>Admin</a></li>");
    }		
	$logoutURI = preg_replace('/(&|\\?)f=([\\w])*/', '', $_SERVER['REQUEST_URI']);
	$Logout = (encoding_strpos($logoutURI, '?') !== false) ? '&amp;f=logout' : '?f=logout';
	$strLogout = encode($logoutURI, ENCODE_HTML) . $Logout;
	echo("<li><a href='$strLogout'>Logout</a></li>");
}
elseif($_ARCHON->config->ForceHTTPS)
{
	echo("<li><a href='index.php?p=core/login&amp;go='>Log In</li>");
	echo("<li><a href='?p=core/register'>Register</a>");
}
else
{
	echo("<li><a href='index.php?p=core/login&amp;go='>Log In</a></li>");
	echo("<li><a href='?p=core/register'>Register</a>");
}


if(!$_ARCHON->Security->userHasAdministrativeAccess())
{

	$emailpage = defined('PACKAGE_COLLECTIONS') ? "collections/research" : "core/contact";
	
	echo("<li><a href='?p={$emailpage}&amp;f=email&amp;referer=" . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . "'>Contact Us</a></li>");
	if($_ARCHON->Security->isAuthenticated())
	{
		echo("<li><a href='?p=core/account&amp;f=account'>My Account (" . $_ARCHON->Security->Session->User->getString('Login') . ")</a></li>");
	}
	if(defined('PACKAGE_COLLECTIONS'))
	{
		$_ARCHON->Security->Session->ResearchCart->getCart();
		$EntryCount = $_ARCHON->Security->Session->ResearchCart->getCartCount();
		$class = $_ARCHON->Repository->ResearchFunctionality & RESEARCH_COLLECTIONS ? '' : 'hidewhenempty';
		$hidden = ($_ARCHON->Repository->ResearchFunctionality & RESEARCH_COLLECTIONS || $EntryCount) ? '' : "style='display:none'";
		
		echo("<li><span id='viewcartlink' class='$class' $hidden><a href='?p=collections/research&amp;f=cart&amp;referer=" . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . "'>View Cart (<span id='cartcount'>$EntryCount</span>)</a></span></li>");
	}
} 
?>
					</ul>	 
				</div>
			</section>
<?php
$arrP = explode('/', $_REQUEST['p']);
$TitleClass = $arrP[0] == 'collections' && $arrP[1] != 'classifications' ? 'currentBrowseLink' : 'browseLink';
$ClassificationsClass = $arrP[1] == 'classifications' ? 'currentBrowseLink' : 'browseLink';
$SubjectsClass = $arrP[0] == 'subjects' ? 'currentBrowseLink' : 'browseLink';
$CreatorsClass = $arrP[0] == 'creators' ? 'currentBrowseLink' : 'browseLink';
$DigitalLibraryClass = $arrP[0] == 'digitallibrary' ? 'currentBrowseLink' : 'browseLink';
?>			
			<section class="classification">
				<h1>Browse by Classifications</h1>			
				<ul>
					<li class="<?php echo($TitleClass); ?>">
						<a href="?p=collections/collections" onclick="js_highlighttoplink(this.parentNode); return true;">
							<strong>Collections</strong>
							<p>Browse all collection titles alphabetically.</p>
						</a>						
					</li>
					<li class="<?php echo($DigitalLibraryClass); ?>">
						<a href="?p=digitallibrary/digitallibrary" onclick="js_highlighttoplink(this.parentNode); return true;">
							<strong>Digital Images</strong>
							<p>Search or browse thumbnails of digitized images.</p>
						</a>
					</li>
					<li class="<?php echo($SubjectsClass); ?>">
						<a href="?p=subjects/subjects" onclick="js_highlighttoplink(this.parentNode); return true;">
							<strong>Subjects</strong>
							<p>Browse all collections by subject and topic.</p>
						</a>
					</li>
					<li class="<?php echo($CreatorsClass); ?>">
						<a href="?p=creators/creators" onclick="js_highlighttoplink(this.parentNode); return true;">
							<strong>Creators</strong>
							<p>Browse all collections by creator name.</p>
						</a>
					</li>
					<li class="<?php echo($ClassificationsClass); ?>">
						<a href="?p=collections/classifications" onclick="js_highlighttoplink(this.parentNode); return true;">
							<strong>Repositories</strong>
							<p>Browse materials by repository and record group.</p>
						</a>
					</li>
				</ul>
			</section>	
<?php if ( ! empty($_SERVER['QUERY_STRING'])) { ?>			
			<section class="search">
				<form action="index.php" accept-charset="UTF-8" method="get" onsubmit="if(!this.q.value) { alert('Please enter search terms.'); return false; } else { return true; }"  role="search">
					<h1><label for="qfa">Keyword Search</label></h1>
					<input name="p" type="hidden" value="core/search" />
					<input id="qfa" maxlength="150" name="q" size="25" title="search" type="search" value="<?php echo(encode($_ARCHON->QueryString, ENCODE_HTML)); ?>" tabindex="100" />
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
			</section>	
<?php } ?>
			<section id="breadcrumbs">
<?php 
$breadcrumbs = $_ARCHON->PublicInterface->createNavigation(); 
/*
$archon_phrase = array('Archon', 'Browse By Collection Title', 'Browse Digital Content', 'Browse by Record Group');
$luther_phrase = array('Nordic', 'Browse By Collection', 'Browse Digital Image', 'Browse by Repository');
$breadcrumbs = str_replace($archon_phrase, $luther_phrase, $breadcrumbs);
*/
echo $breadcrumbs;
?>
			</section>
		</nav>
	</header>		
		
	<div class="group" role="main">
		<div class="container">