<?php
session_start();
require_once("modele/modele.funct.php");

$dbh;
$tab=[];
$rowCount=[];
$page=0;




try{
	$dbh=connexion();

//Reset de la recherche
	if(isset($_POST['reset'])){
		$_SESSION['rechercheCheck']=false;
	}
//Cas où on appuye sur suivant (pas dans une recherche)
	if(isset($_GET['page'])&&!$_SESSION['rechercheCheck']){

		$page=$_GET['page'];
		$tab=searchMainPage($dbh,$page);
		$rowCount=rowCount($dbh);
		require_once("template/template.php");

//Cas où on appuye sur un film pour en avoir le détail
	}elseif(isset($_GET['detail'])){

		$detail=$_GET['detail'];
		$tab=searchDetail($dbh,$detail);
		$real=$tab[0]['real'];
		$tabLike=searchLike($dbh,$real);
		require_once("template/templateDetail.php");

//Cas où on est dans une recherche ou on appuye sur suivant(dans une recherche)
	}elseif(isset($_POST['action'])||isset($_GET['page'])) {

		
		if(isset($_GET['page'])){
			$page=$_GET['page'];
			$input=$_SESSION['input'];
		}else{	
			$input=$_POST['recherche'];
		}
		$_SESSION['rechercheCheck']=true;
		$_SESSION['input']=$input;
		$tab=searchQuery($dbh,$input,$page);
		$rowCount=rowCount($dbh);
		require_once("template/template.php");

//Cas premier chargement du site
	}else{
		$_SESSION['rechercheCheck']=false;
		$tab=searchMainPage($dbh,$page);
		$rowCount=rowCount($dbh);
		require_once("template/template.php");
	}





// var_dump($tab);
}catch (Exception $ex) {
	die("ERREUR FATALE : ". $ex->getMessage().'<form><input type="button" value="Retour" onclick="history.go(-1)"></form>');
}




?>