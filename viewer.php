<?php

//Dossier par defaut
$get="cylindricite";

//Dossier envoyé par GET
if(isset($_GET['specif'])) $get=$_GET['specif'];

// Sécurise la valeur reçue
$get = str_replace("/","_",$get) ;
$get = str_replace("..","_",$get) ;


$dossier="./models/".$get."/";

//Si on se plante dans le dossier à envoyer dans GET
if(!is_dir($dossier))
{
	$dossier="./models/cylindricite/";
}



$chargeNominal=is_file($dossier."nominal.obj") && is_file($dossier."nominal.mtl");
$chargeReel=is_file($dossier."reel.obj") && is_file($dossier."reel.mtl");
$chargeET=is_file($dossier."ET.obj") && is_file($dossier."ET.mtl");
$chargeER1=is_file($dossier."ER1.obj") && is_file($dossier."ER1.mtl");
$chargeER2=is_file($dossier."ER2.obj") && is_file($dossier."ER2.mtl");
$chargeER3=is_file($dossier."ER3.obj") && is_file($dossier."ER3.mtl");
$chargeRS1=is_file($dossier."RS1.obj") && is_file($dossier."RS1.mtl") ;
$chargeRS2=is_file($dossier."RS2.obj") && is_file($dossier."RS2.mtl");
$chargeRS3=is_file($dossier."RS3.obj") && is_file($dossier."RS3.mtl");
$chargeZT=is_file($dossier."ZT.obj") && is_file($dossier."ZT.mtl");
$afficheGrilleGPS=is_file($dossier."/GPS.txt");


// Pour choisir le nom à afficher (à partir du nom du dossier)
$nom=$get;
switch($get)
{
	case "cylindricite":
		$nom="cylindricité";
		break;
	case "circularite":
		$nom="circularité";
		break;
	case "planeite":
		$nom="planéité";
		break;
	case "parallelisme":
		$nom="parallélisme";
		break;
	case "perpendicularite":
		$nom="perpendicularité";
		break;
	case "coaxialite":
		$nom="coaxialité";
		break;
	case "symetrie":
		$nom="symétrie";
		break;
}
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Tolérance de <?php echo $nom;?></title>
        <meta charset="UTF-8" />
    	<meta name="Language" content="fr">
		<meta name="author" content="Raphaël ALLAIS">
		<meta name="category" content="teaching">
		<meta name="description" content="Illustration 3D d'un tolérance de <?php echo $nom;?>, d'après la norme du 'Geometrical Product Specification' (GPS)." />
		<link  href="sources/style.css" rel="stylesheet"/>
			
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/smoothness/jquery-ui.css">
			

        <!-- Import map : lie le module "three" au CDN -->
        <script type="importmap">
          {
            "imports": {
              "three": "https://unpkg.com/three@0.170.0/build/three.module.js",
              "three/examples/jsm/controls/OrbitControls": "https://unpkg.com/three@0.170.0/examples/jsm/controls/OrbitControls.js",
              "three/examples/jsm/loaders/OBJLoader": "https://unpkg.com/three@0.170.0/examples/jsm/loaders/OBJLoader.js",
              "three/examples/jsm/loaders/MTLLoader": "https://unpkg.com/three@0.170.0/examples/jsm/loaders/MTLLoader.js"
            }
          }
        </script>
        <script src="./sources/JS/fonctions.js"></script>
        <script>
             // On crée des reférences vers les objets 3D (encore vide, pour le moment)
             let pieceNominale, pieceReelle, meshET, meshER1, meshER2,meshER3, meshRS1, meshRS2, meshRS3, meshZT
             

        </script>
    </head>
    <body>
    
    
		<!-- bouton Retour ----- -->
		<div class="conteneur_bouton_retour">
		    <a href="<?php echo isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"./";?>">
		        <img title="Retour" src="./sources/images/bouton_retour.svg" />
		    </a>
		</div>

    
    
		<!-- Ensemble de toutes les tabs -------------------------------->
		<div id="tabs">
		
		
            <!------ Boutons des tabs ----- -->
            <ul>
	            <li><a href="#tab1">Modèle 3D</a></li>
	            <li><a href="#tab2">Dessin de définition</a></li>
	            <?php
	            if($afficheGrilleGPS) // Si le fichier Grille GPS existe
	            {echo '<li><a href="#tab3">Matrice GPS</a></li>';}
	            ?>
	            
            </ul>

            <!-- Tab1 (3D) ------------>
            <div id="tab1" class="tab Active">


				<!-- MENU 3D ============================================== -->
				<?php
					include("./sources/PHP/menu3D.php");
				?>



	            <!-- Fin affichage ------------------->

	            <!-- Contenur graphique contenant la 3D ---------->
	            <!--<div style="text-align:center;">-->


				<!-- CONTENEUR 3D ============================================== -->
		        <div id="container" style="margin:auto;"></div>


	            <!--</div>-->
		    </div>
		    
		    
		    
			<!-- Tab de l'affichage du dessin de définition ------>
			<div id="tab2" class="tab">
				<img src="<?php echo $dossier;?>/dessin.png"/>
			</div>
			
			
			
			
    		<!-- Tab de la matrice GPS ------>
			<?php
			if(is_file($dossier."/GPS.txt"))
			{?>
			<div id="tab3" class="tab" style="texte-align:center";>
				<table>
					<tr>
						<th>Nom de la tolérance</th>
						<th>Élément tolérancé<br/>(E.T.)</th>
						<th>Élément de référence<br/>(E.R.)</th>
						<th>Référence spécifiée<br/>(R.S.)</th>
						<th>Zone de tolérance<br/>(Z.T.)</th>
					</tr>
					<tr>
					<?php
						$fichier=fopen($dossier."/GPS.txt","r");
						if($fichier)
						{
							$i=1;
							 while (($line = fgets($fichier)) !== false) 
							{
								echo "\n						<td class='gps".$i."'>".$line."</td>";
								$i++;
							}
						}
					?>
					</tr>
				</table>
			</div>
			<!-- FIN du Tab de l'affichage du dessin de définition ------>
			<?php ;}?>

    
        </div>
		<!-- Fin de l'ensemble des Tabs ----->
    



        <!-- Script gérant le temps de chargement --->
        <script type="text/javascript">
	            //taille des fichiers à charger
	            taille_nominal=0;
	            taille_reel=0;
	            taille_ET=0;
	            taille_ER1=0;
	            taille_ER2=0;
	            taille_ER3=0;
	            taille_RS1=0;
	            taille_RS2=0;
	            taille_RS3=0;
	            taille_ZT=0;

	            taille_totale_nominal=0;
	            taille_totale_reel=0;
	            taille_totale_ET=0;
	            taille_totale_ER1=0;
	            taille_totale_ER2=0;
	            taille_totale_ER3=0;
	            taille_totale_RS1=0;
	            taille_totale_RS2=0;
	            taille_totale_RS3=0;
	            taille_totale_ZT=0;

	            update_barre_progression=function()
	            {
			            var maxi=taille_totale_nominal+taille_totale_reel+taille_totale_ET+taille_totale_RS1+taille_totale_RS2+taille_totale_RS3+taille_totale_ZT;
			            var value=taille_nominal+taille_reel+taille_ET+taille_RS1+taille_RS2+taille_RS3+taille_ZT;

			            $("#iconeChargement progress").attr("max",maxi);
			            $("#iconeChargement progress").attr("value",value);

			            if(maxi==value && maxi!=0)//Si chargement terminé
			            {
					            $("#voileNoir,#iconeChargement").animate({opacity: 0},800,function(){$(this).remove()});
			            }
	            }
        </script>
    
    

		<?php
			// ******************************************************
			// SCENE 3D

			include("./sources/PHP/script_scene3D.php");

			// ******************************************************
		?>


		<script>
			// On transforme les tabs de Jquery-UI en onglet
			$("#tabs").tabs();
				// Un peu de stype pour les tabs
				$(".ui-tabs .ui-tabs-panel").css("padding","0px");
		</script>
		
		
		<!--<div id="voileNoir">
		</div>
		<div id="iconeChargement">
				Chargement...
			<br/>
				<progress max="1" value="0" form="form-id"></progress>
		</div>-->

        <div>
    		<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Licence Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>
    	</div>
  </body>
</html>
