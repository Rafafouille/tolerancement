//Fonction qui calcule la norme d'un vecteur {x:,y:,z:}*************************************
/*function norme(V)
{
	return Math.sqrt(V.x*V.x+V.y*V.y+V.z*V.z);
}*/

 function modifOpacite(obj,val,idCurseur=null)
 {
    // Cas extrêmes pour alléger le rendu
    if(val==1)
    {
        autoriseTransparent(obj,false) // On retire la transparence (plus léger)
        obj.visible=true 
    }
    else if(val==0)
    {
    console.log("prout");
        obj.visible=false   // On rend la piece invisible (textures transparente non-calculée)
    }
    else
    {
        obj.visible=true
        autoriseTransparent(obj,true)
    }
    
    
    obj.traverse(c => {
                if (c.isMesh) {
                        c.material.opacity = val;
                        }
                });
                
    // Gestion des curseurs
    if(idCurseur)  
        $("#"+idCurseur).val(val);  
                
                
                
                
 }
 
 function autoriseTransparent(obj,trans)
 {
    obj.traverse(c => {
                        if (c.isMesh)
                        {
                                c.material.transparent = trans;
                                c.material.needsUpdate = true;
                        }
                    });
 }
     
             
             
             
             
        
// COMPORTEMENT DES BOUTONS

          
// ****************************************************
function afficheReel(value, impactAutresBoutons=true)
{
    if(value) // Si on active
    {
        // Bouton menu
        $("#bouton_nominal").css("display","none");
        $("#bouton_nominal").removeClass("allume");
        $("#bouton_nominal").addClass("eteint");
        $("#bouton_reel").css("display","inline-block");
        $("#bouton_reel").removeClass("eteint");
        $("#bouton_reel").addClass("allume");
        
        // Modèle
        modifOpacite(pieceReelle,1);  
        modifOpacite(pieceNominale,0); 
        
        // Propage aux autres boutons
        if(impactAutresBoutons)
        {
            
        }
    }
    else    // Si on active pas
    {
        // Bouton menu
        $("#bouton_nominal").css("display","inline-block");
        $("#bouton_nominal").removeClass("eteint");
        $("#bouton_nominal").addClass("allume");
        $("#bouton_reel").css("display","none");
        $("#bouton_reel").removeClass("allume");
        $("#bouton_reel").addClass("eteint");
        
        // Modèle
        modifOpacite(pieceReelle,0);  
        modifOpacite(pieceNominale,1); 
        
        
        // Propage aux autres boutons
        if(impactAutresBoutons)
        {
            afficheET(false,false);
            afficheER1(false,false);
            afficheRS1(false,false);
            afficheER2(false,false);
            afficheER3(false,false);
            afficheRS2(false,false);
            afficheRS3(false,false);
            afficheZT(false,false);
        }
    }
}
 
// **************************************************** 
function afficheNominal(value, impactAutresBoutons=true)
{
    afficheReel(!value, impactAutresBoutons);
}



// **************************************************** 
function afficheET(value, impactAutresBoutons=true)
{
    if(typeof meshET!="undefined")
    {
        if(value) // Si on active
        {
            // Bouton menu
            $("#bouton_ET").removeClass("eteint");
            $("#bouton_ET").addClass("allume");
              
            // Modèle
            modifOpacite(meshET,1);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                afficheReel(true, false)
                modifOpacite(pieceReelle,0.5);
                if($("#bouton_ZT").hasClass('allume'))
                    modifOpacite(meshZT,0.5);
            }
        }
        else  // Si on active pas
        {
            // Bouton menu
            $("#bouton_ET").addClass("eteint");
            $("#bouton_ET").removeClass("allume");
            
            // Modèle
            modifOpacite(meshET,0);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                if(!$("#bouton_ER1").hasClass('allume') && !$("#bouton_ER2").hasClass('allume') && !$("#bouton_ER3").hasClass('allume'))
                    modifOpacite(pieceReelle,1);
                if($("#bouton_ZT").hasClass('allume'))
                    modifOpacite(meshZT,1);
            }
        }
    }
}



// **************************************************** 
function afficheER1(value, impactAutresBoutons=true)
{
    if(typeof meshER1!="undefined")
    {
        if(value) // Si on active
        {
            // Bouton menu
            $("#bouton_ER1").removeClass("eteint");
            $("#bouton_ER1").addClass("allume");
              
            // Modèle
            modifOpacite(meshER1,1);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                afficheReel(true, false)
                modifOpacite(pieceReelle,0.5);
            }
        }
        else  // Si on active pas
        {
            // Bouton menu
            $("#bouton_ER1").addClass("eteint");
            $("#bouton_ER1").removeClass("allume");
            
            // Modèle
            modifOpacite(meshER1,0);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                if(!$("#bouton_ET").hasClass('allume') && !$("#bouton_ER2").hasClass('allume') && !$("#bouton_ER3").hasClass('allume'))
                    modifOpacite(pieceReelle,1);
                
            }
        }
    }
}




// **************************************************** 
function afficheER2(value, impactAutresBoutons=true)
{
    if(typeof meshER2!="undefined")
    {
        if(value) // Si on active
        {
            // Bouton menu
            $("#bouton_ER2").removeClass("eteint");
            $("#bouton_ER2").addClass("allume");
              
            // Modèle
            modifOpacite(meshER2,1);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                afficheReel(true, false)
                modifOpacite(pieceReelle,0.5);
            }
        }
        else  // Si on active pas
        {
            // Bouton menu
            $("#bouton_ER2").addClass("eteint");
            $("#bouton_ER2").removeClass("allume");
            
            // Modèle
            modifOpacite(meshER2,0);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                if(!$("#bouton_ET").hasClass('allume') && !$("#bouton_ER1").hasClass('allume') && !$("#bouton_ER3").hasClass('allume'))
                    modifOpacite(pieceReelle,1);
                
            }
        }
    }
}






// **************************************************** 
function afficheER3(value, impactAutresBoutons=true)
{
    if(typeof meshER3!="undefined")
    {
        if(value) // Si on active
        {
            // Bouton menu
            $("#bouton_ER3").removeClass("eteint");
            $("#bouton_ER3").addClass("allume");
              
            // Modèle
            modifOpacite(meshER3,1);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                afficheReel(true, false)
                modifOpacite(pieceReelle,0.5);
            }
        }
        else  // Si on active pas
        {
            // Bouton menu
            $("#bouton_ER3").addClass("eteint");
            $("#bouton_ER3").removeClass("allume");
            
            // Modèle
            modifOpacite(meshER3,0);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                if(!$("#bouton_ET").hasClass('allume') && !$("#bouton_ER1").hasClass('allume') && !$("#bouton_ER2").hasClass('allume'))
                    modifOpacite(pieceReelle,1);
                
            }
        }
    }
}



// **************************************************** 
function afficheRS1(value, impactAutresBoutons=true)
{
    if(typeof meshRS1!="undefined")
    {
        if(value) // Si on active
        {
            // Bouton menu
            $("#bouton_RS1").removeClass("eteint");
            $("#bouton_RS1").addClass("allume");
              
            // Modèle
            modifOpacite(meshRS1,1);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                if($("#bouton_reel").hasClass('eteint'))
                {
                    afficheReel(true, false)
                    modifOpacite(pieceReelle,0.5);
                }
            }
        }
        else  // Si on active pas
        {
            // Bouton menu
            $("#bouton_RS1").addClass("eteint");
            $("#bouton_RS1").removeClass("allume");
            
            // Modèle
            modifOpacite(meshRS1,0);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                
            }
        }
    }
}





// **************************************************** 
function afficheRS2(value, impactAutresBoutons=true)
{
    if(typeof meshRS2!="undefined")
    {
        if(value) // Si on active
        {
            // Bouton menu
            $("#bouton_RS2").removeClass("eteint");
            $("#bouton_RS2").addClass("allume");
              
            // Modèle
            modifOpacite(meshRS2,1);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                if($("#bouton_reel").hasClass('eteint'))
                {
                    afficheReel(true, false)
                    modifOpacite(pieceReelle,0.5);
                }
                afficheRS1(true,false);
            }
        }
        else  // Si on active pas
        {
            // Bouton menu
            $("#bouton_RS2").addClass("eteint");
            $("#bouton_RS2").removeClass("allume");
            
            // Modèle
            modifOpacite(meshRS2,0);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                
            }
        }
    }
}





// **************************************************** 
function afficheRS3(value, impactAutresBoutons=true)
{
    if(typeof meshRS3!="undefined")
    {
        if(value) // Si on active
        {
            // Bouton menu
            $("#bouton_RS3").removeClass("eteint");
            $("#bouton_RS3").addClass("allume");
              
            // Modèle
            modifOpacite(meshRS3,1);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                if($("#bouton_reel").hasClass('eteint'))
                {
                    afficheReel(true, false)
                    modifOpacite(pieceReelle,0.5);
                }
                afficheRS1(true,false);
                afficheRS2(true,false);
            }
        }
        else  // Si on active pas
        {
            // Bouton menu
            $("#bouton_RS3").addClass("eteint");
            $("#bouton_RS3").removeClass("allume");
            
            // Modèle
            modifOpacite(meshRS3,0);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                
            }
        }
    }
}



// **************************************************** 
function afficheZT(value, impactAutresBoutons=true)
{
    if(typeof meshZT!="undefined")
    {
        if(value) // Si on active
        {
            // Bouton menu
            $("#bouton_ZT").addClass("allume");
            $("#bouton_ZT").removeClass("eteint");
        
            // Modèle
            if($("#bouton_ET").hasClass('allume'))
                 modifOpacite(meshZT,0.5);
            else
                modifOpacite(meshZT,1);
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
                if($("#bouton_reel").hasClass("eteint"))
                {
                    afficheReel(true,false);
                }
            }
        }
        else
        {
            // Bouton menu
            $("#bouton_ZT").addClass("eteint");
            $("#bouton_ZT").removeClass("allume");
        
            // Modèle
            modifOpacite(meshZT,0);
            
            
            // Propage aux autres boutons
            if(impactAutresBoutons)
            {
            }
        }
    }
}

              
              
              
              
              
              
    





// Active le nominal
function activeNominal(active)
{
    $("#afficheReel").prop("checked",active);
    
    pieceNominale.visible=active;
    pieceReelle.visible=!active;
}


// Met à jour le bouton et les modèles
// Si affReel = true , on affiche la déformée
function updateAfficheModel(affReel)
{
    if(affReel)
    {
        $("#label_nominal").css("font-weight","normal"); // Labels en gras
        $("#label_reel").css("font-weight","bold");
        modifOpacite(pieceReelle,1,"range_transparence_model");    // Aspect de la géométrie
        modifOpacite(pieceNominale,0);
        $("#afficheModel").prop("checked",true);  // On met le checkbox (si c'est pas fait à la souris)
    }
    else
    {
        $("#label_nominal").css("font-weight","bold");
        $("#label_reel").css("font-weight","normal");
        if(meshET!=undefined)
            updateAfficheET(false);
        modifOpacite(pieceReelle,0);
        modifOpacite(pieceNominale,1,"range_transparence_model");
        $("#afficheModel").prop("checked",false);  // On met le checkbox (si c'est pas fait à la souris)
    }
}



// Met à jour le bouton et les modèles
// Si affET = true , on affiche l'ET
function updateAfficheET(affET)
{
    if(affET)
    {
        $("#elemTolerance").prop("checked",true);  // On met le checkbox (si c'est pas fait à la souris)
        $("#afficheModel").prop("checked",true);  // On met le checkbox (si c'est pas fait à la souris)
         modifOpacite(pieceReelle,0.5,"range_transparence_model");
        modifOpacite(pieceNominale,0);
        $("#label_ET").css("font-weight","bold");
        modifOpacite(meshET,1,"range_transparence_ET");
    }
    else
    {
        $("#elemTolerance").prop("checked",false);  // On met le checkbox (si c'est pas fait à la souris)
        modifOpacite(pieceNominale,0);
        modifOpacite(pieceReelle,1,"range_transparence_model");
        $("#label_ET").css("font-weight","normal");
        modifOpacite(meshET,0,"range_transparence_ET");
        
    }
}



// Met à jour le bouton et les modèles
// Si affET = true , on affiche l'RS
function updateAfficheRS(affRS)
{
    if(affRS)
    {
        $("#refSpecifiee").prop("checked",true);  // On met le checkbox (si c'est pas fait à la souris)
        modifOpacite(meshRS,1,'range_transparence_RS');
        $("#afficheModel").prop("checked",true);  // On met le checkbox (si c'est pas fait à la souris)
        modifOpacite(pieceReelle,0.5,"range_transparence_model");
        modifOpacite(pieceNominale,0);
    }
    else
    {
        modifOpacite(meshRS,0,'range_transparence_RS');
    }
}


// Met à jour le bouton et les modèles
// Si affET = true , on affiche l'ZT
function updateAfficheZT(affZT)
{
    if(affZT)
    {
        $("#zoneTolerance").prop("checked",true);  // On met le checkbox (si c'est pas fait à la souris)
        modifOpacite(meshZT,0.5,'range_transparence_ZT');
        $("#afficheModel").prop("checked",true);  // On met le checkbox (si c'est pas fait à la souris)
         modifOpacite(pieceReelle,0.5,"range_transparence_model");
        modifOpacite(pieceNominale,0);
    }
    else
    {
        modifOpacite(meshZT,0,'range_transparence_ZT');
    }
}
