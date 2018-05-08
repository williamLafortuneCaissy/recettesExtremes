<?php
/* 
Intégration web III - TP1 - Groupe du jeudi
-------------------------------------------------------------------------
Votre nom : William Lafortune-Caissy
-------------------------------------------------------------------------
Cette page affiche la liste des recettes disponibles sur le site
- Inclure le fichier de la class Recette
- Inclure le fichier donnees.php contenant les données des recettes (crée la variable $donnees)
- Commencer par le fichier Recette.class.php
*/

include_once("Recette.class.php");
include_once("donnees.php");

?><!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="recettes.css" />
	<title>Liste des recettes</title>
</head>

<body>
	<div class="interface">
		<!-- /* Inclure l'entête ici */ -->
		<header>
			<h1><a href="index.php">Les recettes <span>extrêmes</span></a></h1>
		</header>
		<!-- /* Faire afficher le fil d'Ariane ici */ -->
		<?php echo Recette::ariane(); ?>
<!--
		<nav>
			<ul id="ariane">
				<li><span>Accueil</span></li>
			</ul>
		</nav>
-->
		<section class="body">
			<!-- /* Faire afficher l'article ici */ -->
			<?php echo Recette::articleIndex($donnees); ?>
<!--
			<article>
				<header>
					<h1>Liste des recettes</h1></header>
				<ul class="categories">
					<li>
						<div><a href="categorie.php?nomCategorie=Accompagnements">Accompagnements</a></div>
						<ul class="recettes">
							<li><a href="recette.php?nomCategorie=Accompagnements&amp;idRecette=la_sauce_piquante_jamaicaine"><span class="vignette" style="background-image:url(images/la_sauce_piquante_jamaicaine.jpg)" title="Pain is good"></span><span>La sauce piquante Jamaïcaine</span></a></li>
							<li><a href="recette.php?nomCategorie=Accompagnements&amp;idRecette=sauce_a_big_mac"><span class="vignette" style="background-image:url(images/sauce_a_big_mac.jpg)" title="La vraie recette de sauce à Big Mac"></span><span>Sauce à Big Mac</span></a></li>
						</ul>
					</li>
					<li>
						<div><a href="categorie.php?nomCategorie=Déjeuners">Déjeuners</a></div>
						<ul class="recettes">
							<li><a href="recette.php?nomCategorie=Déjeuners&amp;idRecette=porridge"><span class="vignette" style="background-image:url(images/porridge.jpg)" title="Porridge à la pomme et à la cannelle"></span><span>Porridge à la pomme et à la cannelle</span></a></li>
						</ul>
					</li>
					<li>
						<div><a href="categorie.php?nomCategorie=Desserts">Desserts</a></div>
						<ul class="recettes">
							<li><a href="recette.php?nomCategorie=Desserts&amp;idRecette=le_sucre_a_la_creme"><span class="vignette" style="background-image:url(images/le_sucre_a_la_creme.jpg)" title="Le meilleur des sucres à la crème"></span><span>Le sucre à la crème</span></a></li>
							<li><a href="recette.php?nomCategorie=Desserts&amp;idRecette=brownies_au_tabasco"><span class="vignette" style="background-image:url(images/brownies_au_tabasco.jpg)" title="Brownies au tabasco"></span><span>Brownies au tabasco</span></a></li>
							<li><a href="recette.php?nomCategorie=Desserts&amp;idRecette=tarte_a_la_farlouche"><span class="vignette" style="background-image:url(images/tarte_a_la_farlouche.jpg)" title="Tarte à la farlouche"></span><span>Tarte à la farlouche</span></a></li>
						</ul>
					</li>
					<li>
						<div><a href="categorie.php?nomCategorie=Boissons">Boissons</a></div>
						<ul class="recettes">
							<li><a href="recette.php?nomCategorie=Boissons&amp;idRecette=hypocras"><span class="vignette" style="background-image:url(images/hypocras.jpg)" title="Les épices pour faire de l'hypocras"></span><span>Hypocras</span></a></li>
							<li><a href="recette.php?nomCategorie=Boissons&amp;idRecette=Claret"><span class="vignette" style="background-image:url(images/Claret.jpg)" title=""></span><span>Claret</span></a></li>
						</ul>
					</li>
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
