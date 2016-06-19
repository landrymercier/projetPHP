$(document).ready(function(){/*verifie si le document est bien charge.*/

	$('a[href^=#]').click(function(){/*selectionne les liens qui commencent par "#".*/
		cible=$(this).attr('href');/*stock le contenu de l'attribut "href" du lien courant.*/
		
		if($(cible).length>0){/*length>0 permet de tester s'il existe une ancre(=$(cible)).*/
			hauteur=$(cible).offset().top;/*permet d'obtenir la hauteur par rapport a la page.*/
		}
		$('html,body').animate({scrollTop:hauteur},1000,'easeOutQuint');
		
		return false;/*desactive le lien pour corriger un bug d'animation*/
	});
});


