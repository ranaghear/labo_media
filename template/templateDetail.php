<?php
require_once("template/template.funct.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="https://kit.fontawesome.com/38ebb92173.js" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200..800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style/normalize.css?id=<?php echo time(); ?>">
	<link rel="stylesheet" href="style/main1.css?id=<?php echo time(); ?>">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Labo : Médiathèque - Détail</title>
</head>
<body>
	<?php
		echo affichageDetail($tab,$tabLike);
	?>
</body>
</html>