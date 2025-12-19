<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Rail de guidage</title>
    </head>

    <body>
			<div id="plan" style="text-align:center;">
				<img style="width:1400px;" usemap="#map" src="./sources/images/dessin-rail-de-guidage.png" title="Dessin de définition de la piéce 'Rail de guidage'" alt="Si cette image ne s'affiche pas, attendez quelques secondes. Sinon, contactez l'administrateur car vous ne pourrez pas continuer..."/>
				<map name="map" id="map">
					 <area shape="rect" coords="298,623,350,647" href="./-RAIL-forme" alt="Tolérance forme quelconque" />
					 <area shape="rect" coords="1122,568,1182,591" href="./-RAIL-planeite" alt="Tolérance de planéité" />
					 <area shape="rect" coords="1120,760,1244,802" href="./-RAIL-localisation" alt="Tolérance de localisation des 3 axes" />
					 <area shape="rect" coords="1083,859,1178,881" href="./-RAIL-perpendicularite" alt="Tolérance de perpendicularité" />
					 <area shape="rect" coords="76,334,146,356" href="./-RAIL-parallelisme" alt="Tolérance de parallelisme" />
					 <area shape="rect" coords="1055,632,1116,652" href="./-RAIL-localisation3" alt="Tolérance de localisation du plan supérieur" />
					 <area shape="rect" coords="1257,507,1316,529" href="./-RAIL-localisation2" alt="Tolérance de localisation du plan inférieur" />
				</map>
			</div>
			
			
		    <!-- texte clique ----- -->
            <div style="position:absolute;top:15px;left:35px;font-size:x-small;text-align:center;width:100%"><em>(Cliquez sur les tolérances pour les afficher en 3D)</em></div>
            
            
		    <!-- bouton Retour ----- -->
		    <div style="width:50px;position:absolute;top:10px;right:10px;font-size:x-small;text-align:right;width:100%" >
		        <a href="./">
		            <img title="Retour" style="width:50px;" src="./sources/images/bouton_retour.svg" />
		        </a>
		    </div>
    </body>
</html>
