<?php

//Dossier par defaut
$dossier="./models/cylindricite/";

//Dossier envoyé par GET
if(isset($_GET['specif'])) $dossier="./models/".$_GET['specif']."/";

//Si on se plante dans le dossier à envoyer dans GET
if(!is_dir($dossier))
	$dossier="./models/cylindricite/";

$afficheET=is_file($dossier."ET.json");
$afficheRS=is_file($dossier."RS.json");
$afficheRS2=is_file($dossier."RS2.json");
$afficheRS3=is_file($dossier."RS3.json");
?>


<!doctype html>
	<html>
		<head>
			<title>Tolérance de cylindricité</title>
			<meta charset="utf-8">
			<link  href="sources/style.css" rel="stylesheet"/>
		</head>
	<body>
	    
		<div id="affichage">
			<form action="#">
					<a href="http://tolerancement.allais.eu" class="button back black"><span></span>Retour</a>
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
				</div>
		</div>

		<div id="container"></div>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
			<script src="http://threejs.org/build/three.min.js"></script>	<!-- http://mrdoob.github.com/three.js/build/three.min.js -->
			<!--<script src="./sources/JS/threejs/STLLoader.js"></script>-->
			<script src="./sources/JS/threejs/Detector.js"></script>
			<script src="./sources/JS/threejs/ColladaLoader.js"></script>
			<script src="./sources/JS/threejs/OrbitControls.js"></script>
			<script type="text/javascript">
	  
				var renderer, scene, camera, mesh;

				dossier="<?php echo $dossier;?>";

				init();
				animate();




				function init(){

					//========================================================================
					// Rendu

					// on initialise le moteur de rendu
					//renderer = new THREE.WebGLRenderer({antialias: true});
					if ( Detector.webgl )
						renderer = new THREE.WebGLRenderer( {antialias:true} );
					else
						renderer = new THREE.CanvasRenderer(); 

					// si WebGL ne fonctionne pas sur votre navigateur vous pouvez utiliser le moteur de rendu Canvas à la place
					// renderer = new THREE.CanvasRenderer();
					renderer.setPixelRatio( window.devicePixelRatio );
					renderer.setSize( window.innerWidth, window.innerHeight );
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
					});


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
					});

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
					});
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
					});
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
					});
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
					});
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
					});

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
	</body>
</html>
