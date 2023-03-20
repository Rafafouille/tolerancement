<!doctype html>
	<html>
		<head>
			<title>Tolérancement géométrique</title>
			<meta charset="utf-8"/>
			<meta name="Language" content="fr">
			<meta name="author" content="Raphaël ALLAIS">
			<meta name="category" content="teaching">
			<meta name="description" content="Illustrations 3D des principale tolérances géométrique, d'après la norme du 'Geometrical Product Specification' (GPS)." />
			<link  href="sources/style.css" rel="stylesheet"/>
			<?php //include_once("sources/Google_Analytics.php") ?>
			<?php include_once("sources/matomo.php"); ?>
		</head>
	<body>
	
	<?php include("bandeau.php")?>
	    
		<h1>Exemples de base du tolérancement géométrique</h1>


			<h2>Tolérances de forme</h2>

				<div class="listeBoutons">
					<div class="boutonMenu">
						<a href="-cylindricite" onclick="_paq.push(['trackEvent', 'modèle',  'cylindricité']);">
							Tolérance de cylindricité<br/>
							<img src="models/cylindricite/dessin.png"/>
						</a>
						<!--<a href="~cylindricite">
							<img style="vertical-align:middle;" alt="VR" src="./sources/images/casqueVR.png"/> <span style="vertical-align:middle">VR (pas encore fonctionnel)</span>
						</a> -->
					</div>
					<div class="boutonMenu">
						<a href="-circularite" onclick="_paq.push(['trackEvent', 'modèle',  'circularité']);">
							Tolérance de circularité<br/>
							<img src="models/circularite/dessin.png"/>
						</a>
					</div>
					<div class="boutonMenu">
						<a href="-planeite" onclick="_paq.push(['trackEvent', 'modèle',  'planéité']);">
							Tolérance de planéité<br/>
							<img src="models/planeite/dessin.png"/>
						</a>
					</div>
					<div class="boutonMenu">
						<a href="-rectitude" onclick="_paq.push(['trackEvent', 'modèle',  'rectitude']);">
							Tolérance de rectitude<br/>
							<img src="models/rectitude/dessin.png"/>
						</a>
					</div>
				</div>

			<h2>Tolérances d'orientation</h2>

				<div class="listeBoutons">
					<div class="boutonMenu">
						<a href="-parallelisme" onclick="_paq.push(['trackEvent', 'modèle',  'parallélisme']);">
							Tolérance de parallélisme<br/>
							<img src="models/parallelisme/dessin.png"/>
						</a>
					</div>
					<div class="boutonMenu">
						<a href="-perpendicularite" onclick="_paq.push(['trackEvent', 'modèle',  'perpendicularité']);">
							Tolérance de perpendicularité<br/>
							<img src="models/perpendicularite/dessin.png"/>
						</a>
					</div>
				</div>

			<h2>Tolérances de position</h2>

				<div class="listeBoutons">
					<div class="boutonMenu">
						<a href="-coaxialite" onclick="_paq.push(['trackEvent', 'modèle',  'coaxialité']);">
							Tolérance de coaxialité<br/>
							<img src="models/coaxialite/dessin.png"/>
						</a>
					</div>
					<div class="boutonMenu">
						<a href="-symetrie" onclick="_paq.push(['trackEvent', 'modèle',  'symétrie']);">
							Tolérance de symétrie<br/>
							<img src="models/symetrie/dessin.png"/>
						</a>
					</div>
					<div class="boutonMenu">
						<a href="-localisation" onclick="_paq.push(['trackEvent', 'modèle',  'localisation']);">
							Tolérance de localisation<br/>
							<img src="models/localisation/dessin.png"/>
						</a>
					</div>
				</div>


		<h2></h2>
		<h1>Levier de platine</h1>

			
				<div class="listeBoutons">
					<div class="boutonMenu">
						<a href="levier-de-platine.php" onclick="_paq.push(['trackEvent', 'modèle',  'leivier de platine']);">
							<img src="./sources/images/bouton-levier-platine.png"/>
						</a>
					</div>
				</div>

		<h2></h2>
		<h1>Rail de guidage</h1>


			
				<div class="listeBoutons">
					<div class="boutonMenu">
						<a href="rail_de_guidage.php" onclick="_paq.push(['trackEvent', 'modèle',  'rail de guidage']);">
							<img src="./sources/images/bouton-rail-de-guidage.png"/>
						</a>
					</div>
				</div>

		<h2></h2>
		<h1>Joue inférieue d'un vanne à servomoteur</h1>


			
				<div class="listeBoutons">
					<div class="boutonMenu">
						<a href="joue_inferieure.php" onclick="_paq.push(['trackEvent', 'modèle',  'joue inférieure']);">
							<img src="./sources/images/bouton_joue_inferieure.png"/>
						</a>
					</div>
				</div>


		<h2></h2>
		<div style="text-align:right;">
			<a href="http://contact.allais.eu?site=tolerancement" target="_blank">
				<img src="./sources/images/icone_mail.png" alt="[ @ ]"/>
			</a>
		</div>
	</body>
</html>
