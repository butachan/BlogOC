<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>accueil blog</title>
		<link rel = "stylesheet" href="css/blogstyle.css" />
		
    </head>
	
	<body>
	
	<?php
	try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'mdp');
		}
	catch(Exception $e)
		{
				die('Erreur : '.$e->getMessage());
		}
	$requete = $bdd->query('SELECT * FROM billets ORDER BY date_creation DESC LIMIT 0,5');
	while ($donnees=$requete->fetch())
	{
			echo '<h3>' . $donnees['titre'] .' le '. $donnees['date_creation'] .'</h3> </br>';
			echo '<p>' .$donnees['contenu'] .'</p>';
		
	echo '<div> <a href="commentaires.php?id= ' .$donnees['id']  . '"> Commentaires </a> </div>';
		
	}
	
	?>
	</body>
	
</html>