<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>validation commentaire</title>
		
		
    </head>
	
	<body>
		<p> salut <?php echo htmlspecialchars($_POST['pseudo']); ?> </br>
		 Votre message : <?php echo htmlspecialchars($_POST['newComment']).'</br> </p>'; 
		 $num = $_GET['id_billet'];
		 $pseudo = htmlspecialchars($_POST['pseudo']);
		 $comment = htmlspecialchars($_POST['newComment']);
		 echo $num;
		 try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'mdp');
		}
		catch(Exception $e)
		{
		die('Echec de la connexion pdo : '.$e-> getMessage());
		}
		
		//verifier si une entree a déjà été validé avant
		$valide= TRUE;
		$verifiedoublon->closeCursor();
		//deuxieme verification
		$verification =$bdd->prepare('SELECT * FROM commentaires WHERE auteur =? ');
		$verification -> execute([$pseudo]);
		$doublon = $verification->fetch();
		if ($doublon){
			echo 'commentaire ou pseudo déjà existant';
			$valide= FALSE;
		} else
		{
			echo 'commentaire approuvé';
		}
		if($valide){
			echo 'votre commentaire est validé';
			$date = date("Y-m-d:i:s");
			echo $date;
			$requete = $bdd->prepare('INSERT INTO commentaires( id_billet ,auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, :date_commentaire)');
			$requete->execute(array(
				'id_billet' =>  $num,
				'auteur' => $_POST['pseudo'],
				'commentaire' => htmlspecialchars($_POST['newComment']),
				 'date_commentaire' => $date));
			$requete->closeCursor();
		}
		
		?>
		
		<a href="commentaires.php?id=<?php echo $num; ?>"> retour à la liste des commentaires </a>
		
	</body>

</html>