<?php
/*page de gestion des droits � OCS
 * 
 * 
 */
 require_once($_SESSION['OCS']['backend'].'require/connexion.php');
$list_methode=array(0=>"local.php");
if (!isset($_SESSION['OCS']["lvluser"])){
	$i=0;
	//methode pour le calcul des droits
	while ($list_methode[$i]){
		require_once('methode/'.$list_methode[$i]);
		//on garde les erreurs pr�sentes
		//entre chaque m�thode
		if (isset($ERROR)){
			$tab_error[$list_methode[$i]]=$ERROR;
			unset($ERROR);
		}
		//on garde les tags qu'a le droit de voir l'utilisateur
		if (isset($list_tag)){
			$tab_tag[$list_methode[$i]]=$list_tag;
			unset($list_tag);
		}
		$i++;
	}
	
}

if (!isset($tab_tag) and $restriction != 'NO'){
	$LIST_ERROR="";
	foreach ($tab_error as $script=>$error){
			$LIST_ERROR.="<font color=red size=5>".$error."</font><br>";		
	}	
}elseif(isset($tab_tag)){
	//print_r($tab_tag);
	foreach ($list_methode as $prio=>$script){
		if (isset($tab_tag[$script])){
			foreach ($tab_tag[$script] as $tag=>$lbl){
				$list_tag[$tag]=$tag;	
				$lbl_list_tag[$tag]=$lbl;		
			}
		}
	}
	
	$mesMachines = "a.TAG IN ('".@implode("','",$list_tag)."') ";	
	$_SESSION['OCS']["mesmachines"] = $mesMachines;
	$_SESSION['OCS']["mytag"]=$lbl_list_tag;
}

if (isset($lvluser))
$_SESSION['OCS']["lvluser"]=$lvluser;


?>