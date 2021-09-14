<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Commentaires</title>
		<link rel = "stylesheet" href="css/blogstyle.css" />
    </head>
 
    <body>
		<h1> Espace Commentaires </h1>
		<?php
		try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'mdp');
			}
		catch(Exception $e)
			{
					die('Erreur : '.$e->getMessage());
			}
		$num = $_GET['id'];

		
		$billet=$bdd->query('SELECT titre, contenu,DATE_FORMAT(date_creation, "%d %m %Y") AS jour, DATE_FORMAT(date_creation, "%Hh%imin%ss") AS heure FROM billets WHERE id="'.$num.'"');
		$afficheBillet=$billet->fetch();
		echo '<div> <h3> '. $afficheBillet['titre'] . ' le '. $afficheBillet['jour'] .' à ' . $afficheBillet['heure'] . '</h3> </br>';
		echo '<p>' .$afficheBillet['contenu'] . '</p> </div>';
		echo '<section> <h2> Commentaires </h2>';
		echo '<div class="news">';
		$reponse = $bdd->query('SELECT * FROM commentaires INNER JOIN billets ON commentaires.id_billet = billets.id WHERE id_billet="'.$num.'"');
		while($demande=$reponse->fetch())
		{
			echo  ' <span class="auteur">' .$demande['auteur'].'</span> a écrit ' . $demande['commentaire'] .'</br>';
		}
		echo '</div> </section>';
		$reponse->closeCursor();
		echo $num;
		?>
		<h4> laisser un commentaire </h4>
		<form action="commentairebdd.php?id_billet=<?php echo $num; ?>" method="post" >
			<p style="text-align:center">
			<input type="text" name="pseudo" /> </br>
			<textarea name="newComment" rows="4" cols="30" >
			</textarea> </br>
			<input type="submit" value="Valider" />
			</p>
		</form>
		
		
		<a href="indexBlog.php"> retour à la liste des sujets </a>
	</body>
</html>