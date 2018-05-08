<?php
/*
Intégration web III - TP1 - Groupe du jeudi
-------------------------------------------------------------------------
Votre nom : William Lafortune-Caissy
-------------------------------------------------------------------------
- Compléter les méthodes suivantes
- Toutes les méthodes sont statiques
- Conseils :
	- Commencer par créer toutes les méthodes vides avec les bons paramètres et la bonne valeur de retour
	- Faire chaque méthode en oubliant le contexte dans lequel elles seront utilisées. "Elles prennent des données et retournent une valeur. Point final!"
	- Tester CHAQUE méthode individuellement en ajoutant une ligne de test à la fin de ce document (comme pour l'exercice "objet divers". La ligne de test doit être à l'extérieur de la classe.
*/
class Recette {
	/** 
	 * Méthode "fraction" qui 
	 * @param  string $valeur - Une chaîne représentant un nombre avec potentiellement une fraction
	 * @return string - une chaine avec les balises créant une fraction
	 */
	static public function fraction($valeur) {
		$parties = explode(" ", $valeur);
		if (count($parties) > 1) {
			return $parties[0] . self::fraction($parties[1]);
		}
		$parties = explode("/", $valeur);
		if (count($parties) == 1) {
			return $parties[0];
		}
		return '<span class="fraction"><sup>'.$parties[0].'</sup>/<sub>'.$parties[1].'</sub></span>';
	}

	/** 
	 * Méthode "trouverRecette" qui retourne le array représentant une recette. 
	 * En fonction de la catégorie et du id envoyés en paramètres. 
	 * Si la catégorie n'existe pas ou la recette n'existe pas pour cette catégorie, on retourne false
	 * @param array  $recettes     - Le array contenant les recettes
	 * @param string $nomCategorie - La catégorie à rechercher
	 * @param string $idRecette    - la recette à rechercher dans la catégorie
	 * @return array	- Le array de la recette ou false
	 */
    static public function trouverRecette($recettes, $nomCategorie, $idRecette) {
        $arrayRecette = '';
        if (isset($recettes[$nomCategorie][$idRecette])) {
            $arrayRecette = $recettes[$nomCategorie][$idRecette];  
        } else {
            $arrayRecette = false;
        }
        
        return $arrayRecette;
//        if (isset($_GET['nomCategorie']) && isset($_GET['idRecette'])){
//            $categorie = $_GET['nomCategorie'];
//            $idRecette = $_GET['idRecette'];
//        } else {
//            header("location:index.php");
//            exit;
//        }
        
//        if (isset($_GET['nomCategorie'])){
//            $categorie = $_GET['nomCategorie'];
//        } else {
//            header("location:index.php");
//            exit;
//        }
    }

	/** 
	 * Méthode "ariane" qui retourne la balise nav contenant le fil d'Ariane
	 * @param  string $nomCategorie - La catégorie à traiter. Valeur par défaut: ""
	 * @param  string $titreRecette   - Le titre de la recette qui est affichée. Valeur par défaut: ""
	 * @return string - Le HTML de la balise nav
	 */
	static public function ariane($nomCategorie=NULL, $titreRecette=NULL) {
        $ariane ='';

        $ariane .= '<nav>';
        $ariane .= '<ul id="ariane">';
        
        if ($nomCategorie) {
            $ariane .= '<li><a href="index.php">Accueil</a></li>';
            if (isset($titreRecette)){
                $ariane .= '<li><a href="categorie.php?nomCategorie='.$nomCategorie.'">'.$nomCategorie.'</a></li>';
                $ariane .= '<li><span>'.$titreRecette.'</span></li>';
            } else {
                $ariane .= '<li><span>'.$nomCategorie.'</span></li>';
            }    
        } else {
            $ariane .= '<li><span>Accueil</span></li>';
        }
        
        $ariane .= '</nav>';
        $ariane .= '</ul>';
        
        return $ariane;
    }

	/**
	 * Méthode "image" qui retourne l'image de la recette donnée. 
	 * Si $vignette est true, alors on retourne le span.vignette sinon, on retourne figure.photoprincipale
	 * @param  string  $idRecette   - le id de la recette (donc le nom du fichier)
	 * @param  array   $recette     - la recette comme telle
	 * @param  boolean $vignette	- s'agit-il d'une vignette?  Valeur par défaut : false
	 * @return string  - Le HTML du figure ou d'un span
	 */
    static public function image($idRecette, $recette, $vignette=false) {
        $image = '';
        
        if ($vignette === true) {
            $image .= '<span class="vignette">';
        } else {
            $image .= '<figure class="photoprincipale"><img src="images/'.$idRecette.'.jpg" alt="'.$recette['titre'].'" title="'.$recette['titre'].'">';
            $image .= '<figcaption>'.$recette['titre'].'</figcaption>';
            $image .= '</figure>';
        }
        
        return $image;        
    }

	/** 
	 * Méthode "lien" qui retourne le lien vers une recette
	 * Note : Cette méthode utilise la méthode "image"
	 * @param  string $nomCategorie - Le nom de la catégorie
	 * @param  string $idRecette    - Le id de la recette
	 * @param  array  $recette      - La recette comme telle
	 * @return string - Le HTML d'une balise a
	 */
	static public function lien($nomCategorie, $idRecette, $recette) {
        $lien = '';
                
        $lien .= '<a href="recette.php?nomCategorie='.$nomCategorie.'&amp;';
        if (isset($idRecette)) {
            $lien .= 'idRecette='.$idRecette.'">';
        }
        $lien .= '<span class="vignette" style="background-image:url(images/'.$idRecette.'.jpg)" title="'.$recette['legende'].'"></span>';
        $lien .= '<span>'.$recette['titre'].'</span>';
        $lien .= '</a>';
        
        return $lien;
    }

	/** 
	 * Méthode "ingredients" qui retourne la liste des ingrédients (ul.ingredients) donnée
	 * Note : Cette méthode utilise la méthode "fraction"
	 * @param  array  $ingredients - un tableau d'ingrédients. Voir le format dans donnees.php
	 * @return string - une balise ul
	 */
    static public function ingredients($ingredients) {
        $listeIngredients = '';
        
        $listeIngredients .= '<ul class="ingredients">';
        foreach ($ingredients as $unite) {
            $listeIngredients .= '<li>';
            foreach ($unite as $cle => $valeur) {
                $listeIngredients .= '<span class="'.$cle.'">'.$valeur.'</span>';
            }
            $listeIngredients .= '</li>';
        }
        $listeIngredients .= '</ul>';
        
        return $listeIngredients;
    }

	/** 
	 * Méthode "instructions" qui returne la liste des instructions (ol.instructions) donnée
	 * @param  array  $instructions - La liste des instructions. Voir le format dans donnees.php
	 * @return string - une balise ol
	 */
	static public function instruction($instructions) {
        $listeInstruction = '';
        
        $listeInstruction .= '<ol class="instructions">';
        foreach ($instructions as $valeur) {
            $listeInstruction .= '<li>'.$valeur.'</li>';
        }
        $listeInstruction .= '</ol>';
        
        return $listeInstruction;
    }

	/** 
	 * Méthode "listeRecettes" qui retourne le HTML du ul.recettes qui fait la liste des recettes d'une catégorie
	 * Note : Cette méthode utilise la méthode "lien"
	 * @param  string $nomCategorie - Le nom de la categorie
	 * @param  array  $recettes     - La liste des recettes à afficher
	 * @return string - Le HTML d'une balise ul
	 */
	static public function listeRecettes ($nomCategorie, $recettes) {
        $listeRecette = '';
        
        $listeRecette .= '<ul class="recettes">';
        foreach($recettes as $idRecette => $recette) {
            $listeRecette .= '<li>';
            $listeRecette .= Recette::lien($nomCategorie, $idRecette, $recette);
            $listeRecette .= '</li>';
        }
        $listeRecette .= '</ul>';
        
        return $listeRecette;
    }

	/** 
	 * Méthode "listeCategories" qui retourne le HTML du ul.categories qui fait la liste des catégories
	 * Note : Cette méthode utilise la méthode "listeRecettes"
	 * @param  [[Type]]Array $categories [[Description]] La liste des catégories et leur recettes
	 * @return [[Type]]string [[Description]] Le HTML d'une balise ul
	 */
    static public function listeCategories ($categories) {
        $listeCategories = '';
        
        $listeCategories .= '<ul class="categories">';
        foreach ($categories as $nomCategorie => $recettes) {
            $listeCategories .= '<li>';
            $listeCategories .= '<div><a href="categorie.php?nomCategorie='.$nomCategorie.'">'.$nomCategorie.'</a></div>';
            $listeCategories .= Recette::listeRecettes($nomCategorie, $recettes);
            $listeCategories .= '</li>';
        }
        $listeCategories .= '</ul>';
            
        return $listeCategories;
    }

	/** 
	 * Méthode "articleRecette" qui retourne le HTML de l'article de la page recette.php
	 * Note : Cette méthode utilise les méthodes "image", "ingredients" et "instructions"
	 * @param  string $idRecette - Le id de la recette à afficher
	 * @param  array  $recette   - Les informations d'une recette (voir le format dans donnees.php)
	 * @return string - Le HTML d'une balise article
	 */
	static public function articleRecette ($idRecette, $recette) {
        $articleRecette = '';
        
        $articleRecette .= '<article>';
        $articleRecette .= '<header><h1>'.$recette['titre'].'</h1></header>';
        $articleRecette .= '<p class="intro">'.$recette['intro'].'</p>';
        $articleRecette .= Recette::image($idRecette, $recette);
        $articleRecette .= $recette['description'];
        $articleRecette .= '<h2>Ingrédients</h2>';
        $articleRecette .= Recette::ingredients($recette['ingredients']);
        $articleRecette .= '<h2>Instructions</h2>';
        $articleRecette .= Recette::instruction($recette['instructions']);
        $articleRecette .= '</article>';
        
        return $articleRecette;
    }

	/** 
	 * Méthode "articleCategorie" qui retourne le HTML de l'article de la page categorie.php
	 * Note : Cette méthode utilise la méthode "articleCategorie"
	 * @param  string $nomCategorie      - Le nom de la catégorie à afficher
	 * @param  array  $recettesCategorie - Les recettes appartenant à cette catégorie
	 * @return string - Le HTML d'une balise article
	 */
	
    static public function articleCategorie ($nomCategorie, $recettesCategorie) {
        $articleCategorie = '';
        
        $articleCategorie .= '<article>';
        $articleCategorie .= '<header><h1>'.$nomCategorie.'</h1></header>';
        $articleCategorie .= '<ul class="recettes">';
        $articleCategorie .= Recette::listeRecettes($nomCategorie, $recettesCategorie);
        $articleCategorie .= '</ul></article>';
        
        return $articleCategorie;
    }

	/** 
	 * Méthode "articleIndex" qui retourne le HTML de l'article de la page index.php
	 * Note : Cette méthode utilise la méthode "listeCategories"
	 * @param  array  $recettes - La liste des catégories et leur recettes
	 * @return string - Le HTML d'une balise article
	 */
	static public function articleIndex ($recettes) {
        $articleIndex = '';
        
        $articleIndex .= '<article>';
        $articleIndex .= '<header><h1>Liste des recettes</h1></header>';
        $articleIndex .= Recette::listeCategories($recettes);
        $articleIndex .= '</article>';
        
        return $articleIndex;
    }
	
}

/*LIGNE DE TEST*/
//echo Recette::ariane('Dessert');
//echo Recette::image("le_sucre_a_la_creme.jpg", "Le meilleur des sucres à la crème");
//echo Recette::lien("Desert", "idRecette", "recette");
//$idients = array(
//    array('quantite'=>'200', 'unite'=>'g', 'ingredient'=>'piments habanero jaunes ou orangés, frais, équeutés et émincés avec les pépins (environ une vingtaine)', ),
//    array('quantite'=>'1/2', 'unite'=>'tasse', 'ingredient'=>'chair de mangue en petits dés', ),
//    array('quantite'=>'1/2', 'unite'=>'tasse', 'ingredient'=>'chair de papaye en petits dés', ),
//    array('quantite'=>'1/2', 'unite'=>'tasse', 'ingredient'=>'chair de tomates rouges en petits dés', ),
//    array('quantite'=>'1/2', 'unite'=>'tasse', 'ingredient'=>'cassonade foncée', ),
//    array('quantite'=>'1 1/2', 'unite'=>'tasse', 'ingredient'=>'vinaigre de vin rouge (6 % d\'acide acétique, minimum)', ),
//    array('quantite'=>'', 'unite'=>'', 'ingredient'=>'jus de 2 citrons verts', ),
//    array('quantite'=>'', 'unite'=>'', 'ingredient'=>'zestes fins d\'un citron vert', ),
//    array('quantite'=>'3', 'unite'=>'', 'ingredient'=>'échalotes grises émincées', ),
//    array('quantite'=>'3', 'unite'=>'', 'ingredient'=>'gousses d\'ail pelées, écrasées et hachées menu', ),
//);
//echo Recette::ingredients($idients);
//
//$itions = array(
//    'Placez tout ça dans une petite casserole en inox ou en verre et porter à frémissements en remuant toujours.',
//    'Laisser mijoter tout doucement en remuant souvent pour 20 ou 25 minutes.',
//    'Retirer du feu, couvrir et laisser tiédir.',
//    'Passez le tout au mélangeur pour obtenir une consistance lisse. Attention aux éclaboussures. Goûtez, avec un verre de lait sous la main.',
//    'Verser le tout dans la casserole et reporter à ébullition, à feu moyen, en remuant toujours. Si c\'est trop épais, ajoutez du vinaigre ou du jus de citron dilué dans autant d\'eau. Laisser bouillir une minute avant d\'empoter.',
//    'Empoter en laissant <span class="fraction"><sup>1</sup>/<sub>4</sub></span> de pouce (6 mm) d\'espace d\'air irrespirable sous le goulot.',
//);
//echo Recette::instruction($itions);
//
//
//echo Recette::fraction('10 3/4');
//include_once "donnees.php";
//$recettes = $donnees["Accompagnements"];