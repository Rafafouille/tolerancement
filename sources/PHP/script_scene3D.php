     <script type="module">
            // Appel des modules
            import * as THREE from 'three';
            import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls';
            import { OBJLoader } from 'three/examples/jsm/loaders/OBJLoader';
            import { MTLLoader } from 'three/examples/jsm/loaders/MTLLoader';
            
            
			var dossier="<?php echo $dossier;?>";
            
            // Création de la scène
            const scene = new THREE.Scene();
            scene.background = new THREE.Color(0xFFFFFF);

            // Caméra
            const camera = new THREE.PerspectiveCamera(50, window.innerWidth / (window.innerHeight-70), 1, 1000);
            camera.position.x = 10;
            camera.position.y = 4;
            camera.position.z = 7;

            // Rendu
            const renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setSize(window.innerWidth, window.innerHeight-70);
            const container = document.getElementById('container');
            container.appendChild(renderer.domElement);

            // Géométrie : cube simple
            /*const geometry = new THREE.BoxGeometry();
            const material = new THREE.MeshStandardMaterial({ color: 0x00ff88 });
            const cube = new THREE.Mesh(geometry, material);
            scene.add(cube);*/

            // Lumière
            
		    const light = new THREE.AmbientLight( 0xDDDDDD );
		    scene.add( light );
            const light1 = new THREE.DirectionalLight( 0xffffff ,2);
			light1.position.set( 100, 50, 10 );
			scene.add(light1);
			const light2 = new THREE.DirectionalLight( 0xffffff ,2);
			light2.position.set( -100, -50, -10 );
			scene.add(light2);
            
             // --- ORBIT CONTROLS ---
             const controls = new OrbitControls(camera, renderer.domElement);
             //controls.enableDamping = true; // mouvement fluide
             //controls.dampingFactor = 0.05;
             controls.enableZoom = true; // zoom souris activé
             
              // --- CHARGEMENT DES MODÈLES ---    
              // Fonction utilitaire pour charger un modèle avec ses matériaux
              function loadModel(nom){  //objPath, mtlPath, position) {
                const mtlLoader = new MTLLoader();
                const objLoader = new OBJLoader();    
                var objPath = dossier+nom+".obj";
                var mtlPath = dossier+nom+".mtl";
                return new Promise((resolve, reject) => {
                  mtlLoader.load(mtlPath, (materials) => {
                  
					if(nom!="reel"&&nom!="nominal") // On autorise à voir le matériau des deux faces
						materials.side = THREE.DoubleSide;
                    materials.preload();
//                    materials.side = THREE.DoubleSide;
                    objLoader.setMaterials(materials);
                    objLoader.load(
                      objPath,
                      (object) => {
                        //object.position.copy(position);
                        object.visible=false;
                        scene.add(object);
                        resolve(object); // Lié à Promise
                      },
                      undefined,
                      (error) => reject(error)
                    );
                  });
                });
              }
             
             // --- Exemple : charger 2 modèles de manière asynchrone---
              Promise.all([<?php
                // On appelle la fonction qui renvoie les "promesses" de chargement, en lui passant le nom des fichiers à charger (sans l'extension)
                if($chargeNominal) echo "loadModel('nominal'),";    //dossier+'/nominal.obj', dossier+'/nominal.mtl', new THREE.Vector3(0, 0, 0)),";
                if($chargeReel) echo "loadModel('reel'),";          //dossier+'/reel.obj', dossier+'/reel.mtl', new THREE.Vector3(0, 0, 0)),";
                if($chargeET) echo "loadModel('ET'),";              //dossier+'/ET.obj', dossier+'/ET.mtl', new THREE.Vector3(0, 0, 0)),";
                if($chargeER1) echo "loadModel('ER1'),";              //dossier+'/ER.obj', dossier+'/ER.mtl', new THREE.Vector3(0, 0, 0)),";
                if($chargeER2) echo "loadModel('ER2'),";              //dossier+'/ER2.obj', dossier+'/ER2.mtl', new THREE.Vector3(0, 0, 0)),";
                if($chargeER3) echo "loadModel('ER3'),";              //dossier+'/ER3.obj', dossier+'/ER3.mtl', new THREE.Vector3(0, 0, 0)),";
                if($chargeRS1) echo "loadModel('RS1'),";              //dossier+'/RS.obj', dossier+'/RS.mtl', new THREE.Vector3(0, 0, 0)),";
                if($chargeRS2) echo "loadModel('RS2'),";            //dossier+'/RS.obj', dossier+'/RS.mtl', new THREE.Vector3(0, 0, 0)),";
                if($chargeRS3) echo "loadModel('RS3'),";            //dossier+'/RS3.obj', dossier+'/RS3.mtl', new THREE.Vector3(0, 0, 0)),";
                if($chargeZT) echo "loadModel('ZT')";               //dossier+'/ZT.obj', dossier+'/ZT.mtl', new THREE.Vector3(0, 0, 0)),";
              ?>])// ...puis stockage dans les différentes variables
              .then((listePromesses)=>{
                                [<?php echo ($chargeNominal?"pieceNominale,":"");
                                       echo ($chargeReel?"pieceReelle,":"");
                                       echo ($chargeET?"meshET,":"");
                                       echo ($chargeER1?"meshER1,":"");
                                       echo ($chargeER2?"meshER2,":"");
                                       echo ($chargeER3?"meshER3,":"");
                                       echo ($chargeRS1?"meshRS1,":"");
                                       echo ($chargeRS2?"meshRS2,":"");
                                       echo ($chargeRS3?"meshRS3,":"");
                                       echo ($chargeZT?"meshZT":"");?>] = listePromesses;
                                       
                                       <?php
                                       echo ($chargeNominal ?"modifOpacite(pieceNominale,1);\n                                       pieceReelle.renderOrder=1000 // Pour imposer que le rendu soit en dernier pour bien gérer la transparence\n":"");
                                       echo ($chargeReel ?"                                       modifOpacite(pieceReelle,0);\n":"");
                                       echo ($chargeET ?"                                       modifOpacite(meshET,0);\n":"");
                                       echo ($chargeER1 ?"                                       modifOpacite(meshER1,0);\n":"");
                                       echo ($chargeER2 ?"                                       modifOpacite(meshER2,0);\n":"");
                                       echo ($chargeER3 ?"                                       modifOpacite(meshER3,0);\n":"");
                                       echo ($chargeRS1 ?"                                       modifOpacite(meshRS1,0);\n":"");
                                       echo ($chargeRS2 ?"                                       modifOpacite(meshRS2,0);\n":"");
                                       echo ($chargeRS3 ?"                                       modifOpacite(meshRS3,0);\n":"");
                                       echo ($chargeZT ?"                                       modifOpacite(meshZT,0);\n":"");
                                       ?>
                            }
              );
             
             
             
             
             
            // Animation
            function animate() {
                          requestAnimationFrame(animate);
                          renderer.render(scene, camera);
                    }
            animate();

            // Redimensionnement adaptatif
            window.addEventListener('resize', () => {
              camera.aspect = window.innerWidth / (window.innerHeight-70);
              camera.updateProjectionMatrix();
              renderer.setSize(window.innerWidth, (window.innerHeight-70));
            });
        </script>
