<?php 
//====================================================================================
// OCS INVENTORY REPORTS
// Copyleft Pierre LEMMET 2006
// Web: http://ocsinventory.sourceforge.net
//
// This code is open source and may be copied and modified as long as the source
// code is always made freely available.
// Please refer to the General Public Licence http://www.gnu.org/ or Licence.txt
//====================================================================================
//Modified on $Date: 2006-12-21 18:13:47 $$Author: plemmet $($Revision: 1.5 $)

if( isset($_POST["systemid"]) )
	$_GET["systemid"] = $_POST["systemid"];
	
if( isset($_POST["del"])) {
	$ok = deleteAll();
	if( $ok ) {
		echo "<script language='javascript'>window.location='index.php?redo=1".$_SESSION["queryString"]."';</script>";
		die();
	}	
}

if( isset($_GET["systemid"]))
	$nbMach = 1;
else
	$nbMach = getCount($_SESSION["storedRequest"]);

PrintEnTete( $l->g(122)." <font class='warn'>($nbMach ".$l->g(478).")</font>");

echo "<br><center><a href='#' OnClick='window.location=\"index.php?redo=1".$_SESSION["queryString"]."\";'><= ".$l->g(188)."</a></center>";
echo "<br><br><form action='index.php?multi=27' method='post'><center><b>".$l->g(525)."</b></center>";
if( isset($_GET["systemid"]) ) {
	echo "<input type='hidden' value='".$_GET["systemid"]."' name='systemid'>";
} 
echo "<br><center><input type='submit' value=\"".$l->g(455)."\" name='del'></form></center>";
	
	function deleteAll( ) {
		
		global $_GET;
		if( isset($_GET["systemid"])) {
			deleteDid( $_GET["systemid"] );
		}
		else {
			$lareq = getPrelim( $_SESSION["storedRequest"] );
			if( ! $res = @mysql_query( $lareq, $_SESSION["readServer"] ))
				return false;
			while( $val = @mysql_fetch_array($res)) {
				deleteDid( $val["h.id"] );
			}
		}
		return true;		
		
	}
?>
