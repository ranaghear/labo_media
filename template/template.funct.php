<?php


function affichageAffiche($tab,$rowCount,$page){
	$genreSolo=[];
	$ret="";


	$ret.="<div class ='header'>
	<div class='logo'><a href='index.php'><img src='images/screeny_top_logoonly.png'></a></div>
	<p></p>
	<div class ='search'>
	<form action='index.php' method='post'>
	<input class ='searchbar' type='text' name='recherche' placeholder='Search' ><button class ='searchbarButton' type='submit' name='action' value=''><i class=\"fa-solid fa-magnifying-glass\" style=\"color: #5e005c;\"></i></button>

	</form>
	</div><p></p></div>";

	$ret.="<div class='affiche'>";
	foreach ($tab as $value) {
		$value['duree']=date('h\hi', mktime(0,$value['duree']));
		$ret.="<div class='image'>";	
		$ret.="<a href='index.php?detail=$value[id]'><img src='images/$value[affiche]'>";
		$ret.="<div class='overlay'>";
		$ret.="<div class='text'>";
		$ret.="<p class='titreOverlay'>{$value['titre']}</p>";
		$ret.="<div class='infoOverlay'>";
		if($value['genre']){
			$genreSolo=explode(",", $value['genre']);
			for($i=0;$i<count($genreSolo);$i++){
				$ret.="<div class='infoOverlayGenre'>{$genreSolo[$i]}</div>";
			}
		}
		$ret.="<p>{$value['duree']}</p></div>";
		$ret.="</div><p class='clickInfo'>Click for Info</p>";
		$ret.="</div></a>";
		$ret.="</div>";
	}
	$ret.="</div>";
	$ret.="<div class='pagination'>$page";
	
	for($i=0;$i<($rowCount[0]['amountResult']/9);$i++){
		if($i==$page){
			$ret.="<i class='fa-solid fa-circle fa-2xl' style='color: #5e005c;'></i>";
		}else{

			$ret.="<i class='fa-regular fa-circle fa-xl' style='color: #9e9e9e;''></i>";
		}
	}	
	
	return $ret;
}
function affichageAfficheSearch($tab,$input,$rowCount,$page){
	$genreSolo=[];
	$ret="";


	$ret.="<div class ='header'>
	<div class='logo'><a href='index.php'><img src='images/screeny_top_logoonly.png'></a></div>
	<p></p>
	<div class ='search'>
	<form action='index.php' method='post'>
	<input class ='searchbar' type='text' name='recherche' placeholder='Search' ><button class ='searchbarButton' type='submit' name='action' value=''><i class=\"fa-solid fa-magnifying-glass\" style=\"color: #5e005c;\"></i></button>

	</form>
	</div><p></p></div>";

	if($_SESSION['rechercheCheck']){
		$ret.="<div class='searchFor'>";
		$ret.="Search for '$input'</div>";
	}
	$ret.="<div class='affiche'>";
	foreach ($tab as $value) {
		$value['duree']=date('h\hi', mktime(0,$value['duree']));
		$ret.="<div class='image'>";	
		$ret.="<a href='index.php?detail=$value[id]'><img src='images/$value[affiche]'>";
		$ret.="<div class='overlay'>";
		$ret.="<div class='text'>";
		$ret.="<p class='titreOverlay'>{$value['titre']}</p>";
		$ret.="<div class='infoOverlay'>";
		if($value['genre']){
			$genreSolo=explode(",", $value['genre']);
			for($i=0;$i<count($genreSolo);$i++){
				$ret.="<div class='infoOverlayGenre'>{$genreSolo[$i]}</div>";
			}
		}
		$ret.="<p>{$value['duree']}</p></div>";
		$ret.="</div><p class='clickInfo'>Click for Info</p>";
		$ret.="</div></a>";
		$ret.="</div>";
	}
	$ret.="</div>";
	$ret.="<div class='pagination'>";
	
	for($i=0;$i<($rowCount[0]['amountResult']/9);$i++){
		if($i==$page){
			$ret.="<i class='fa-solid fa-circle fa-2xl' style='color: #5e005c;'></i>";
		}else{

			$ret.="<i class='fa-regular fa-circle fa-xl' style='color: #9e9e9e;''></i>";
		}
	}	
	return $ret;
}

function affichageDetail($tab,$tabLike){
	$ret="";
	$ret.="<div class ='header'>
	<div class='logo'><a href='index.php'><img src='images/screeny_top_logoonly.png'></a></div>
	</div></div>";
	$tab[0]['duree']=date('h\hi', mktime(0,$tab[0]['duree']));
	$ret.="<div class='all'><div class='film'>
	<div class='imageDetail'>
	<img src='images/{$tab[0]['image']}' >
	</div>
	<div classe='info'>
	<div class ='titreEtDate'>
	<h2>{$tab[0]['titre']}</h2>
	<div class='date'>{$tab[0]['date']}</div>
	</div><br>
	<span class='fat'>Genre : </span>{$tab[0]['genre']}<br>
	<span class='fat'>Réalisateur : </span>{$tab[0]['real']}<br>
	<span class='fat'>Acteurs : </span>{$tab[0]['acteur']}<br>
	<span class='fat'>Durée : </span>{$tab[0]['duree']}<br><br><br>
	<p>{$tab[0]['resume']}</p>
	</div>
	</div>";
	$ret.="<div class='filmsLike'><p>Films du même réalisateur :</p></div>";
	$ret.="<div class='affiche'>";
	foreach ($tabLike as $value) {
		$value['duree']=date('h\hi', mktime(0,$value['duree']));
		if($value['titre']!=$tab[0]['titre']){
		$ret.="<div class='image'>";	
		$ret.="<a href='index.php?detail=$value[id]'><img src='images/$value[affiche]'>";
		$ret.="<div class='overlay'>";
		$ret.="<div class='text'>";
		$ret.="<p class='titreOverlay'>{$value['titre']}</p>";
		$ret.="<div class='infoOverlay'>";
		if($value['genre']){
			$genreSolo=explode(",", $value['genre']);
			for($i=0;$i<count($genreSolo);$i++){
				$ret.="<div class='infoOverlayGenre'>{$genreSolo[$i]}</div>";
			}
		}
		$ret.="<p>{$value['duree']}</p></div>";
		$ret.="</div><p class='clickInfo'>Click for Info</p>";
		$ret.="</div></a>";
		$ret.="</div>";
	}
		}
	$ret.="</div></div>";
	$ret.="<div class='buttonPrec'><a href='index.php'><img src='images/screeny_arrows_L.png'></a></div>";
	return $ret;
}

function suivantPrecedentButton($page,$tab,$rowCount){
	$ret="";
	$pagePrec;
	$pageSuiv;
	$ret.="<div class='buttonNav'>";
	if($page!=0){
		$pagePrec=$page-1;
		$ret.="<div class='buttonPrec'><a href='index.php?page=$pagePrec'><img src='images/screeny_arrows_L.png'></a></div>";
	}
	$ret.="<p></p>";
	if(($page+1)*10<=$rowCount[0]['amountResult']){
		$pageSuiv=$page+1;
		$ret.="<div class='buttonNext'><a href='index.php?page=$pageSuiv'><img src='images/screeny_arrows_R.png'></a></div>";
	}
	$ret.="</div>";
	return $ret;
}
?>