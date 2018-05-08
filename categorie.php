<?php
/* 
Intégration web III - TP1 - Groupe du jeudi
-------------------------------------------------------------------------
Votre nom : William Lafortune-Caissy
-------------------------------------------------------------------------
Cette page affiche la liste des recettes en fonction de la catégorie fournie dans l'adresse
- Inclure le fichier de la class Recette
- Inclure le fichier donnees.php contenant les données des recettes (crée la variable $donnees)
- Commencer par le fichier Recettes.class.php

- Cette page s'attend à recevoir de l'adresse la donnée "nomCategorie". Il faut donc récupérer cette donnée.
- S'il manque la catégorie dans l'adresse, on DOIT retourner à la page index.php
- Si la catégorie ne se trouve pas dans la variable $donnees, on DOIT retourner à la page index.php
*/
include_once 'Recette.class.php';
include_once 'donnees.php';

if (isset($_GET['nomCategorie'])){
    $categorie = $_GET['nomCategorie'];
} else {
    header("location:index.php");
    exit;
}

?><!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="recettes.css" />
	<!-- /* Afficher le nom de la catégorie dans le title */ -->
	<?php echo '<title>'.$categorie.'</title>;' ?>
<!--	<title>Desserts</title>-->
</head>

<body>
	<div class="interface">
		<!-- /* Inclure l'entête ici */ -->
		<header>
			<h1><a href="index.php">Les recettes <span>extrêmes</span></a></h1>
		</header>
		<!-- /* Faire afficher le fil d'Ariane ici */ -->
		<?php echo Recette::ariane($categorie); ?>
<!--
		<nav>
			<ul id="ariane">
				<li><a href="index.php">Accueil</a></li>
				<li><span>Desserts</span></li>
			</ul>
		</nav>
-->
		<section class="body">
			<!-- /* Faire afficher l'article ici */ -->
			<?php echo Recette::articleCategorie($categorie, $donnees[$categorie]); ?>
<!--
			<article>
				<header>
					<h1>Desserts</h1></header>
				<ul class="recettes">
					<li><a href="recette.php?nomCategorie=Desserts&amp;idRecette=le_sucre_a_la_creme"><span class="vignette" style="background-image:url(images/le_sucre_a_la_creme.jpg)" title="Le meilleur des sucres à la crème"></span><span>Le sucre à la crème</span></a></li>
					<li><a href="recette.php?nomCategorie=Desserts&amp;idRecette=brownies_au_tabasco"><span class="vignette" style="background-image:url(images/brownies_au_tabasco.jpg)" title="Brownies au tabasco"></span><span>Brownies au tabasco</span></a></li>
					<li><a href="recette.php?nomCategorie=Desserts&amp;idRecette=tarte_a_la_farlouche"><span class="vignette" style="background-image:url(images/tarte_a_la_farlouche.jpg)" title="Tarte à la farlouche"></span><span>Tarte à la farlouche</span></a></li>
				</ul>
			</article>
-->
		</section>
		<!-- /* Inclure le pied de page ici */ -->
		<footer>
			<p>Travail fait dans le cadre du cours "<a target="_blank" href="http://prof-tim.cstj.qc.ca/cours/web3">Intégration Web III</a>".</p>
		</footer>
	</div>
</body>

</html>
