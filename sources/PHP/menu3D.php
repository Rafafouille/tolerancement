        <div id="menu3D">
        
                <div class="groupe_boutons">
                    <div class="bouton allume" id="bouton_nominal" title="Afficher le modèle réel" onclick="afficheReel(true)"><img src="./sources/images/icone_nominal.png" alt="[ ]" height="50px;" /></div>
                    <div class="bouton eteint" id="bouton_reel" title = "Afficher le modèle nominal" style="display:none;" onclick="afficheNominal(true)"><img src="./sources/images/icone_reel.png" alt="{ }" height="50px;" /></div>
                </div>
                
                <?php if($chargeET) {?>
                <div class="groupe_boutons">
                    <div class="bouton eteint" id="bouton_ET" title="Afficher/cacher l'élement tolérancé" onclick="afficheET($(this).hasClass('eteint'))"><img src="./sources/images/icone_ET.png" alt="[ET]" height="50px;" /></div>
                </div> <?php }
                 if($chargeER1) {?>
                <div class="groupe_boutons">
                    <div class="bouton eteint" id="bouton_ER1" title="Afficher/cacher l'élement de référence n°1" onclick="afficheER1($(this).hasClass('eteint'))"><img src="./sources/images/icone_ER1.png" alt="[ER]" height="50px;" /></div>
                </div><?php }
                 if($chargeER2) {?>
                <div class="groupe_boutons">
                    <div class="bouton eteint" id="bouton_ER2" title="Afficher/cacher l'élement de référence n°2" onclick="afficheER2($(this).hasClass('eteint'))"><img src="./sources/images/icone_ER2.png" alt="[ER2]" height="50px;" /></div>
                </div><?php }
                 if($chargeER3) {?>
                <div class="groupe_boutons">
                    <div class="bouton eteint" id="bouton_ER3" title="Afficher/cacher l'élement de référence n°3" onclick="afficheER3($(this).hasClass('eteint'))"><img src="./sources/images/icone_ER3.png" alt="[ER3]" height="50px;" /></div>
                </div><?php }
                 if($chargeRS1) {?>
                <div class="groupe_boutons">
                    <div class="bouton eteint" id="bouton_RS1" title="Afficher/cacher la référence spécifiée n°1"  onclick="afficheRS1($(this).hasClass('eteint'))"><img src="./sources/images/icone_RS1.png" alt="[RS1]" height="50px;" /></div>
                </div><?php }
                 if($chargeRS2) {?>
                <div class="groupe_boutons">
                    <div class="bouton eteint" id="bouton_RS2" title="Afficher/cacher la référence spécifiée n°2" onclick="afficheRS2($(this).hasClass('eteint'))"><img src="./sources/images/icone_RS2.png" alt="[RS2]" height="50px;" /></div>
                </div><?php }
                 if($chargeRS3) {?>
                <div class="groupe_boutons">
                    <div class="bouton eteint" id="bouton_RS3" title="Afficher/cacher la référence spécifiée n°3" onclick="afficheRS3($(this).hasClass('eteint'))"><img src="./sources/images/icone_RS3.png" alt="[RS3]" height="50px;" /></div>
                </div><?php }
                 if($chargeZT) {?>
                <div class="groupe_boutons">
                    <div class="bouton eteint" id="bouton_ZT" title="Afficher/cacher la zone de tolérance" onclick="afficheZT($(this).hasClass('eteint'))"><img src="./sources/images/icone_ZT.png" alt="[ZT]" height="50px;" /></div>
                </div><?php }?>
                <!--
	            <div id="affichage">
		            <form action="#">
		                <div class="groupe_boutons" id="groupe_boutons_modele">
		                    <label id="label_nominal" for="afficheModel" style="font-weight:bold;"></span class="ui">Nominal</span></label>
		                    <input type="checkbox" id="afficheModel" name="afficheModel" onclick='updateAfficheModel($(this).prop("checked"))'/>
		                    <label id="label_reel" for="afficheModel"></span class="ui">Réel</span></label>
		                    <br/>
		                    <input type="range" id="range_transparence_model" name="range_transparence_model" min="0" max="1" step="0.05" value="1" oninput="if($('#afficheModel').prop('checked')){modifOpacite(pieceReelle,$(this).val())}else{modifOpacite(pieceNominale,$(this).val())}"/>
		                </div>
		                
			            <!-<input type="checkbox" id="afficheNominal" name="afficheNominalReel" checked="checked" onclick='activeNominal(!$(this).prop("checked"))'/>
			            <label for="afficheNominal"><span class="ui"></span>Nominal</label>
			            <span class="interBouton"></span>
			            
			            <input type="checkbox" id="afficheReel" name="afficheNominalReel" onclick='$("#afficheNominal").prop("checked",!$(this).prop("checked"));pieceReelle.visible=$(this).prop("checked");pieceNominale.visible=!$(this).prop("checked")'/>
			            <label for="afficheReel"><span class="ui"></span>Réel</label>->
			            
			            <span class="interBouton"></span>
			            <?php if($chargeET) {?>
			            <div class="groupe_boutons" id="groupe_boutons_ET">
			                <input type="checkbox" id="elemTolerance" name="elemTolerance" onclick='updateAfficheET($(this).prop("checked"));'/>
			                <label id="label_ET" for="elemTolerance"><span class="ui"></span>Élément tolérancé</label>
			                <span class="interBouton"></span>
		                    <br/>
		                    <input type="range" id="range_transparence_ET" name="range_transparence_ET" min="0" max="1" step="0.05" value="1" oninput="modifOpacite(meshET,$(this).val())"/>
    	                </div>
			            <?php } ?>

			            <?php if($chargeER1) {?>
						<div class="groupe_boutons" id="groupe_boutons_ER1">
			            	<input type="checkbox" id="elemRef1" name="elemRef1" onclick='updateAfficheER($(this).prop("checked"));'/>
			            	<label for="elemRef1"><span class="ui"></span>Élément de référence</label>
		                    <br/>
		                    <input type="range" id="range_transparence_ER1" name="range_transparence_ER1" min="0" max="1" step="0.05" value="1" oninput="modifOpacite(meshER1,$(this).val())"/>
						</div>
			            <span class="interBouton"></span>
			            <?php } ?>

			            <?php if($chargeRS1) {?>
						<div class="groupe_boutons" id="groupe_boutons_RS">
			            	<input type="checkbox" id="refSpecifiee" name="refSpecifiee" onclick='updateAfficheRS($(this).prop("checked"));'/>
			            	<label for="refSpecifiee"><span class="ui"></span>Référence spécifiée</label>
		                    <br/>
		                    <input type="range" id="range_transparence_RS" name="range_transparence_RS" min="0" max="1" step="0.05" value="1" oninput="modifOpacite(meshRS,$(this).val())"/>
						</div>
			            <span class="interBouton"></span>
			            <?php } ?>
			            <?php if($chargeRS2) {?>
			            <input type="checkbox" id="refSpecifiee2" name="refSpecifiee2" onclick='meshRS2.visible=$(this).prop("checked");if($(this).prop("checked")){$("#refSpecifiee").prop("checked",true);meshRS.visible=true;}else{$("#refSpecifiee3").prop("checked",false);meshRS3.visible=false;}'/>
			            <label for="refSpecifiee2"><span class="ui"></span>Référence spécifiée 2</label>
			            <span class="interBouton"></span>
			            <?php } ?>
			            <?php if($chargeRS3) {?>
			            <input type="checkbox" id="refSpecifiee3" name="refSpecifiee3" onclick='meshRS3.visible=$(this).prop("checked");if($(this).prop("checked")){$("#refSpecifiee").prop("checked",true);meshRS.visible=true;$("#refSpecifiee2").prop("checked",true);meshRS2.visible=true;}'/>
			            <label for="refSpecifiee3"><span class="ui"></span>Référence spécifiée 3</label>
			            <span class="interBouton"></span>
			            <?php } ?>
			            <div class="groupe_boutons" id="groupe_boutons_ZT">
			                <input type="checkbox" id="zoneTolerance" name="zoneTolerance"  onclick='updateAfficheZT($(this).prop("checked"));'/>
			                <label for="zoneTolerance"><span class="ui"></span>Zone de tolérance</label>
		                    <br/>
		                    <input type="range" id="range_transparence_ZT" name="range_transparence_ZT" min="0" max="1" step="0.05" value="1" oninput="modifOpacite(meshZT,$(this).val())"/>
			            </div>
		            </form>
	            </div>-->

                
        </div>
