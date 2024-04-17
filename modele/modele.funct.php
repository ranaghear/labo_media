<?php
function connexion(){
    $dbh = new PDO(
        "mysql:dbname=mediatheque;host=localhost;port=3306",
        "root",
        "",
        array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );
    return $dbh;
}

function searchMainPage($dbh,$page){
    $page=$page*9;
    $sql="select SQL_CALC_FOUND_ROWS films_titre as 'titre',films_affiche as 'affiche',films_duree as 'duree',real_nom as 'real',group_concat(genres_nom) as 'genre',films_id as 'id'
    from films
    join realisateurs on films_real_id=real_id
    left join films_genres on films_id=fg_films_id
    left join genres on fg_genres_id=genres_id
    group by films_titre,films_affiche,films_duree
    limit :start,9;";
    $stmt = $dbh -> prepare($sql);
    $stmt->bindValue('start',$page,PDO::PARAM_INT);
    $stmt->execute(); 
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $tab=$stmt->fetchAll(); 
    return $tab;
}

function rowCount($dbh){
    $sql="select FOUND_ROWS() as 'amountResult';";
    $stmt = $dbh -> prepare($sql);
    $stmt->execute(); 
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $tab=$stmt->fetchAll();
    return $tab;
}

function searchDetail($dbh,$id){
    $sql="select films_titre as 'titre',films_resume as 'resume',films_annee as 'date',films_affiche as 'image',films_duree as 'duree',group_concat(distinct acteurs_nom) as 'acteur',real_nom as 'real',group_concat(distinct genres_nom) as 'genre', films_id as 'id'
    from films
    left join films_acteurs on films_id=fa_films_id
    left join films_genres on films_id=fg_films_id
    left join genres on fg_genres_id=genres_id
    left join acteurs on fa_acteurs_id=acteurs_id
    left join realisateurs on films_real_id=real_id
    group by films_titre,films_affiche,films_duree
    having films_id=:id";
    $stmt = $dbh -> prepare($sql);
    $stmt->bindValue('id',$id,PDO::PARAM_INT);
    $stmt->execute(); 
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $tab=$stmt->fetchAll();
    return $tab;
}

function searchQuery($dbh,$input,$page){
    $page=$page*9;
    $sql="select SQL_CALC_FOUND_ROWS films_titre as 'titre',films_resume as 'resume',films_annee as 'date',films_affiche as 'affiche',films_duree as 'duree',group_concat(distinct acteurs_nom) as 'acteur',real_nom as 'real',group_concat(distinct genres_nom) as 'genre', films_id as 'id'
    from films
    left join films_acteurs on films_id=fa_films_id
    left join films_genres on films_id=fg_films_id
    left join genres on fg_genres_id=genres_id
    left join acteurs on fa_acteurs_id=acteurs_id
    left join realisateurs on films_real_id=real_id
    group by films_titre,films_affiche,films_duree
    having films_titre like :rech or films_resume like :rech or films_annee like :rech or films_affiche like :rech or films_duree like :rech or real_nom like :rech
    or acteur like :rech or genre like :rech
    limit :start,9";
    $stmt = $dbh -> prepare($sql);
    $input="%".$input."%";
    $stmt->bindValue('rech',$input,PDO::PARAM_STR);
    $stmt->bindValue('start',$page,PDO::PARAM_INT);
    $stmt->execute(); 
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $tab=$stmt->fetchAll();
    return $tab;
}

function searchLike($dbh,$real){
    $sql="select films_affiche as 'affiche', films_titre as'titre', films_duree as'duree', group_concat(distinct genres_nom) as'genre',films_id as 'id'
            from films
            left join films_genres on films_id=fg_films_id
            left join genres on fg_genres_id=genres_id
            left join realisateurs on films_real_id=real_id
            where real_nom=:real
            group by films_titre,films_affiche,films_duree;";
            $stmt=$dbh -> prepare($sql);
            $stmt->bindValue('real',$real,PDO::PARAM_STR);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $tab=$stmt->fetchAll();
            return $tab;
}
?>