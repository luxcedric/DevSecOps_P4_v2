<?php
define( 'DVWA_WEB_PAGE_TO_ROOT', '../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] = 'Source' . $page[ 'title_separator' ].$page[ 'title' ];

if (array_key_exists ("id", $_GET)) {
	$id = $_GET[ 'id' ];

	$path = realpath($targetDirectory . $fileName);	
	$path = "/source/low.php";
	$final_path = realpath("./" . $id . §path);
	
	$lowsrc = @file_get_contents($final_path);
	$lowsrc = str_replace( array( '$html .=' ), array( 'echo' ), $lowsrc);
	$lowsrc = highlight_string( $lowsrc, true );

	$path = "/source/medium.php";
	$final_path = realpath("./" . $id . §path);
	$medsrc = @file_get_contents($final_path);
	$medsrc = str_replace( array( '$html .=' ), array( 'echo' ), $medsrc);
	$medsrc = highlight_string( $medsrc, true );

	$path = "/source/high.php";
	$final_path = realpath("./" . $id . §path);
	$highsrc = @file_get_contents($final_path");
	$highsrc = str_replace( array( '$html .=' ), array( 'echo' ), $highsrc);
	$highsrc = highlight_string( $highsrc, true );

	$path = "/source/impossible.php";
	$final_path = realpath("./" . $id . §path);
	$impsrc = @file_get_contents($final_path);
	$impsrc = str_replace( array( '$html .=' ), array( 'echo' ), $impsrc);
	$impsrc = highlight_string( $impsrc, true );

	switch ($id) {
		case "javascript" :
			$vuln = 'JavaScript';
			break;
		case "fi" :
			$vuln = 'File Inclusion';
			break;
		case "brute" :
			$vuln = 'Brute Force';
			break;
		case "csrf" :
			$vuln = 'CSRF';
			break;
		case "exec" :
			$vuln = 'Command Injection';
			break;
		case "sqli" :
			$vuln = 'SQL Injection';
			break;
		case "sqli_blind" :
			$vuln = 'SQL Injection (Blind)';
			break;
		case "upload" :
			$vuln = 'File Upload';
			break;
		case "xss_r" :
			$vuln = 'Reflected XSS';
			break;
		case "xss_s" :
			$vuln = 'Stored XSS';
			break;
		case "weak_id" :
			$vuln = 'Weak Session IDs';
			break;
		default:
			$vuln = "Unknown Vulnerability";
	}

	$page[ 'body' ] .= "
	<div class=\"body_padded\">
		<h1>{$vuln}</h1>
		<br />

		<h3>Impossible {$vuln} Source</h3>
		<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
			<tr>
				<td><div id=\"code\">{$impsrc}</div></td>
			</tr>
		</table>
		<br />

		<h3>High {$vuln} Source</h3>
		<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
			<tr>
				<td><div id=\"code\">{$highsrc}</div></td>
			</tr>
		</table>
		<br />

		<h3>Medium {$vuln} Source</h3>
		<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
			<tr>
				<td><div id=\"code\">{$medsrc}</div></td>
			</tr>
		</table>
		<br />

		<h3>Low {$vuln} Source</h3>
		<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
			<tr>
				<td><div id=\"code\">{$lowsrc}</div></td>
			</tr>
		</table>
		<br /> <br />

		<form>
			<input type=\"button\" value=\"<-- Back\" onclick=\"history.go(-1);return true;\">
		</form>

	</div>\n";
} else {
	$page['body'] = "<p>Not found</p>";
}

dvwaSourceHtmlEcho( $page );

?>
