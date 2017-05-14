<?php

//Dossier par defaut
$get="cylindricite";

//Dossier envoyé par GET

if(isset($_GET['specif'])) $get=$_GET['specif'];
$dossier="./models/".$get."/";

//Si on se plante dans le dossier à envoyer dans GET
if(!is_dir($dossier))
	$dossier="./models/cylindricite/";

$afficheET=is_file($dossier."ET.json");
$afficheRS=is_file($dossier."RS.json");
$afficheRS2=is_file($dossier."RS2.json");
$afficheRS3=is_file($dossier."RS3.json");


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



<!doctype html>
	<html>
		<head>
			<title>Tolérance de <?php echo $nom;?></title>
			<meta charset="utf-8"/>
			<meta name="Language" content="fr">
			<meta name="author" content="Raphaël ALLAIS">
			<meta name="category" content="teaching">
			<meta name="description" content="Illustration 3D d'un tolérance de <?php echo $nom;?>, d'après la norme du 'Geometrical Product Specification' (GPS)." />
			<link  href="sources/style.css" rel="stylesheet"/>
			<!-- Bibli Javascript --------------->

			<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
			<script src="http://libs.allais.eu/threeJS/three.min.js"></script>	<!-- http://mrdoob.github.com/three.js/build/three.min.js -->
			<!--<script src="./sources/JS/threejs/STLLoader.js"></script>-->
			<script src="http://libs.allais.eu/threeJS/Detector.js"></script>
			<script src="http://libs.allais.eu/threeJS/ColladaLoader.js"></script>
			<script src="http://libs.allais.eu/threeJS/OrbitControls.js"></script>
			<!--<script src="./sources/JS/jquery-ui/external/jquery/jquery.js"></script>-->
			<script src="./sources/JS/jquery-ui/jquery-ui.min.js"></script>
			<link rel="stylesheet" href="./sources/JS/jquery-ui/jquery-ui.css">
		</head>
	<body>

	    
		<!-- Ensemble de toutes les tabs -------------------------------->
		<div id="tabs">

			<!------ Boutons des tabs ----- -->
			<ul>
				<li><a href="#tab1">Modèle 3D</a></li>
				<li><a href="#tab2">Dessin de définition</a></li>
				<?php
				if(is_file($dossier."/GPS.txt"))
				{echo '<li><a href="#tab3">Matrice GPS</a></li>';}
				?>
				
			</ul>

			<!-- Tab1 (3D) ------------>
			<div id="tab1" class="tab Active">

				<!-- Bouton Affichage 3D ----------------------->
				<div id="affichage">
					<form action="#">
						<input type="checkbox" id="afficheNominal" name="afficheNominalReel" checked="checked" onclick='$("#afficheReel").prop("checked",!$(this).prop("checked"));pieceNominale.visible=$(this).prop("checked");pieceReelle.visible=!$(this).prop("checked")'/>
						<label for="afficheNominal"><span class="ui"></span>Nominal</label>
						<span class="interBouton"></span>
						<input type="checkbox" id="afficheReel" name="afficheNominalReel" onclick='$("#afficheNominal").prop("checked",!$(this).prop("checked"));pieceReelle.visible=$(this).prop("checked");pieceNominale.visible=!$(this).prop("checked")'/>
						<label for="afficheReel"><span class="ui"></span>Réel</label>
						<span class="interBouton"></span>
						<?php if($afficheET) {?>
						<input type="checkbox" id="elemTolerance" name="elemTolerance" onclick='meshET.visible=$(this).prop("checked");pieceReelle.material.transparent=$(this).prop("checked");pieceReelle.material.opacity=1-0.5*$(this).prop("checked");'/>
						<label for="elemTolerance"><span class="ui"></span>Élément tolérancé</label>
						<span class="interBouton"></span>
						<?php } ?>
						<?php if($afficheRS) {?>
						<input type="checkbox" id="refSpecifiee" name="refSpecifiee" onclick='meshRS.visible=$(this).prop("checked");if(!$(this).prop("checked")){$("#refSpecifiee2").prop("checked",false);meshRS2.visible=false;$("#refSpecifiee3").prop("checked",false);meshRS3.visible=false;}'/>
						<label for="refSpecifiee"><span class="ui"></span>Référence spécifiée</label>
						<span class="interBouton"></span>
						<?php } ?>
						<?php if($afficheRS2) {?>
						<input type="checkbox" id="refSpecifiee2" name="refSpecifiee2" onclick='meshRS2.visible=$(this).prop("checked");if($(this).prop("checked")){$("#refSpecifiee").prop("checked",true);meshRS.visible=true;}else{$("#refSpecifiee3").prop("checked",false);meshRS3.visible=false;}'/>
						<label for="refSpecifiee2"><span class="ui"></span>Référence spécifiée 2</label>
						<span class="interBouton"></span>
						<?php } ?>
						<?php if($afficheRS3) {?>
						<input type="checkbox" id="refSpecifiee3" name="refSpecifiee3" onclick='meshRS3.visible=$(this).prop("checked");if($(this).prop("checked")){$("#refSpecifiee").prop("checked",true);meshRS.visible=true;$("#refSpecifiee2").prop("checked",true);meshRS2.visible=true;}'/>
						<label for="refSpecifiee3"><span class="ui"></span>Référence spécifiée 3</label>
						<span class="interBouton"></span>
						<?php } ?>
						<input type="checkbox" id="zoneTolerance" name="zoneTolerance"  onclick='meshZT.visible=$(this).prop("checked");'/>
						<label for="zoneTolerance"><span class="ui"></span>Zone de tolérance</label>
					</form>
				</div>
				<!-- Fin affichage ------------------->

				<!-- Contenur graphique contenant la 3D ---------->
				<div style="text-align:center;">
					<div id="container" style="margin:auto;"></div>
				</div>


				<!-- Script gérant le temps de chargement --->
				<script type="text/javascript">
						//taille des fichiers à charger
						taille_nominal=0;
						taille_reel=0;
						taille_ET=0;
						taille_RS1=0;
						taille_RS2=0;
						taille_RS3=0;
						taille_ZT=0;

						taille_totale_nominal=0;
						taille_totale_reel=0;
						taille_totale_ET=0;
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



				<!-- Script JAVASCRIPT générant la 3D ----------->
				<script type="text/javascript">
	  
					var renderer, scene, camera, mesh;

					dossier="<?php echo $dossier;?>";

					init();
					animate();



					function init(){


						//Loader Manager, permettant d'afficher le chargement des objets ================
						var manager = new THREE.LoadingManager();
						manager.onProgress = function ( item, loaded, total ) {
									  			console.log("Chargement : "+(loaded/total*100)+"%");
										};


						//========================================================================
						// Rendu

						// on initialise le moteur de rendu
						if ( Detector.webgl )
							renderer = new THREE.WebGLRenderer( {antialias:true} );
						else
							renderer = new THREE.CanvasRenderer(); 

						// si WebGL ne fonctionne pas sur votre navigateur vous pouvez utiliser le moteur de rendu Canvas à la place
						// renderer = new THREE.CanvasRenderer();
						renderer.setPixelRatio( window.devicePixelRatio );
						renderer.setSize( window.innerWidth*0.9, window.innerHeight );
						renderer.setClearColor( 0xffffff, 1 );
						document.getElementById('container').appendChild(renderer.domElement);
						render.shadowMapEnabled = true;
						// on initialise la scène
						scene = new THREE.Scene();

						//========================================================================
						// Camera

						// on initialise la camera que l’on place ensuite sur la scène
						camera = new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 1, 10000 );
						camera.position.set(0, 0, 30);


						controls = new THREE.OrbitControls( camera, renderer.domElement );
						//controls.addEventListener( 'change', render ); // add this only if there is no animation loop (requestAnimationFrame)
						controls.enableDamping = true;
						controls.dampingFactor = 0.25;
						controls.enableZoom = true;
						scene.add(camera);
						    
						// on créé un  cube au quel on définie un matériau puis on l’ajoute à la scène 
						/*var geometry = new THREE.CubeGeometry( 5, 5, 5 );
						var material = new THREE.MeshLambertMaterial( { color: 0xff0000, wireframe: false} );
						mesh = new THREE.Mesh( geometry, material );
						scene.add( mesh );*/

					
						//========================================================================
						// MODELS

						// prepare STL loader and load the model
						var loader = new THREE.JSONLoader();

						loader.load(dossier+'nominal.json',function(geometry){
																									materialeNominal = new THREE.MeshLambertMaterial({color:0xffff00});//new THREE.MeshBasicMaterial( { color: 0xff0000, wireframe: false } );//new THREE.MeshNormalMaterial();//
																									pieceNominale = new THREE.Mesh(geometry, materialeNominal);
																									//pieceNominale.rotation.set( - Math.PI / 2, 0, Math.PI / 2);
																									pieceNominale.position.set(0, 0, 0);
																									pieceNominale.scale.set(2, 2, 2);
																									scene.add(pieceNominale);
																									renderer.render( scene, camera );
																							},
																						function (progression){
																									taille_nominal=progression.loaded;
																									taille_totale_nominal=progression.total;
																									update_barre_progression();
																						}
						);





						// prepare STL loader and load the model
						//var oStlLoader = new THREE.STLLoader();
						loader.load(dossier+'reel.json', function(geometry) {
																							materialeReel = new THREE.MeshLambertMaterial({color:0xffff00});//new THREE.MeshBasicMaterial( { color: 0xff0000, wireframe: false } );//new THREE.MeshNormalMaterial();//
																							pieceReelle = new THREE.Mesh(geometry, materialeReel);
																							//pieceReelle.rotation.set( - Math.PI / 2, 0, Math.PI / 2);
																							pieceReelle.position.set(0, 0, 0);
																							pieceReelle.scale.set(2, 2, 2);
																							pieceReelle.visible=false;
																							scene.add(pieceReelle);
																							renderer.render( scene, camera );
																					},
																						function (progression){
																									taille_reel=progression.loaded;
																									taille_totale_reel=progression.total;
																									update_barre_progression();
																						}
						);


						// prepare STL loader and load the model
						<?php if($afficheET) {?>
						loader.load(dossier+'ET.json', function(geometry) {
																								materialeET = new THREE.MeshLambertMaterial({color:0x0000ff});//new THREE.MeshBasicMaterial( { color: 0xff0000, wireframe: false } );//new THREE.MeshNormalMaterial();//
																								meshET = new THREE.Mesh(geometry, materialeET);
																								//meshET.rotation.set( - Math.PI / 2, 0, Math.PI / 2);
																								meshET.position.set(0, 0, 0);
																								meshET.scale.set(2, 2, 2);
																								meshET.visible=false;
																								scene.add(meshET);
																								renderer.render( scene, camera );
																						},
																						function (progression){
																									taille_ET=progression.loaded;
																									taille_totale_ET=progression.total;
																									update_barre_progression();
																						}
						);
						<?php } ?>

						// prepare STL loader and load the model
						<?php if($afficheRS) {?>
						loader.load(dossier+'RS.json', function(geometry) {
																								materialeRS = new THREE.MeshLambertMaterial({color:0x00ff00, transparent: true, opacity: 0.5});//new THREE.MeshBasicMaterial( { color: 0xff0000, wireframe: false } );//new THREE.MeshNormalMaterial();//
																								meshRS = new THREE.Mesh(geometry, materialeRS);
																								//meshRS.rotation.set( - Math.PI / 2, 0, Math.PI / 2);
																								meshRS.position.set(0, 0, 0);
																								meshRS.scale.set(2, 2, 2);
																								meshRS.visible=false;
																								scene.add(meshRS);
																								renderer.render( scene, camera );
																						},
																						function (progression){
																									taille_RS1=progression.loaded;
																									taille_totale_RS1=progression.total;
																									update_barre_progression();
																						}
						);
						<?php } ?>

						// prepare STL loader and load the model
						<?php if($afficheRS2) {?>
						loader.load(dossier+'RS2.json', function(geometry) {
																									materialeRS2 = new THREE.MeshLambertMaterial({color:0x00ff00, transparent: true, opacity: 0.5});//new THREE.MeshBasicMaterial( { color: 0xff0000, wireframe: false } );//new THREE.MeshNormalMaterial();//
																									meshRS2 = new THREE.Mesh(geometry, materialeRS2);
																									//meshRS.rotation.set( - Math.PI / 2, 0, Math.PI / 2);
																									meshRS2.position.set(0, 0, 0);
																									meshRS2.scale.set(2, 2, 2);
																									meshRS2.visible=false;
																									scene.add(meshRS2);
																									renderer.render( scene, camera );
																						},
																						function (progression){
																									taille_RS2=progression.loaded;
																									taille_totale_RS2=progression.total;
																									update_barre_progression();
																						}
						);
						<?php } ?>

						// prepare STL loader and load the model
						<?php if($afficheRS3) {?>
						loader.load(dossier+'RS3.json', function(geometry) {
																									materialeRS3 = new THREE.MeshLambertMaterial({color:0x00ff00, transparent: true, opacity: 0.5});//new THREE.MeshBasicMaterial( { color: 0xff0000, wireframe: false } );//new THREE.MeshNormalMaterial();//
																									meshRS3 = new THREE.Mesh(geometry, materialeRS3);
																									//meshRS.rotation.set( - Math.PI / 2, 0, Math.PI / 2);
																									meshRS3.position.set(0, 0, 0);
																									meshRS3.scale.set(2, 2, 2);
																									meshRS3.visible=false;
																									scene.add(meshRS3);
																									renderer.render( scene, camera );
																						},
																						function (progression){
																									taille_RS3=progression.loaded;
																									taille_totale_RS3=progression.total;
																									update_barre_progression();
																						}
						);
						<?php } ?>

						// prepare STL loader and load the model
						loader.load(dossier+'ZT.json', function(geometry) {
																									materialZT = new THREE.MeshLambertMaterial({color:0xff0000, transparent: true, opacity: 0.5});//MeshBasicMaterial( { color: 0xff0000, wireframe: false } );//new THREE.MeshNormalMaterial();//
																									meshZT = new THREE.Mesh(geometry, materialZT);
																									//meshZT.rotation.set( - Math.PI / 2, 0, Math.PI / 2);
																									meshZT.position.set(0, 0, 0);
																									meshZT.scale.set(2, 2, 2);
																									meshZT.visible=false;
																									scene.add(meshZT);
																									renderer.render( scene, camera );
																						},
																						function (progression){
																									taille_ZT=progression.loaded;
																									taille_totale_ZT=progression.total;
																									update_barre_progression();
																						}
						);

						//========================================================================
						// LIGHTS
					
						light1 = new THREE.DirectionalLight( 0xffffff ,1);
						light1.position.set( 100, 50, 10 );
						scene.add(light1);
	/*
						light = new THREE.DirectionalLight( 0xffffff ,1);
						light.position.set( 50, 0, 0 );
						scene.add( light );*/
						light = new THREE.AmbientLight( 0x555555 );
						scene.add( light );

						//========================================================================
						// 1er rendu 
						// on effectue le rendu de la scène
						renderer.render( scene, camera );
					}



					function animate() {

						requestAnimationFrame( animate );

						controls.update(); // required if controls.enableDamping = true, or if controls.autoRotate = true


						render();

					}

					function render() {

						renderer.render( scene, camera );

					}

				</script>
				<!-- fin du Script JAVASCRIPT générant la 3D ----------->
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

		<!-- bouton Retour ----- -->
		<a href="http://tolerancement.allais.eu" class="button back black"><span></span>Retour</a>

		<script>
			$("#tabs").tabs();
		</script>


		<div id="voileNoir">
		</div>
		<div id="iconeChargement">
				Chargement...
			<br/>
				<progress max="1" value="0" form="form-id"></progress>
		</div>

		<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Licence Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>
	</body>
</html>
