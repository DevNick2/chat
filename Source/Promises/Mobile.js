import {MobileDetect} from './../Funcoes/Config';

let Mobile = new Promise(function(resolve, reject){
	
	var nav_desktop = document.querySelector('#menu-desktop');
	var nav_mobile = document.querySelector('#menu-mobile');
	var main_sistema = document.querySelector('#main');
	var role_main = $(`#${main_sistema.id}`).data('role');

	if(MobileDetect())
	{
		$(`#${nav_mobile.id}`).css({'display':'flex'}); 
		$(`#${nav_desktop.id}`).css({'display':'none'});

		if(role_main == 'sistema')
			$(`#${main_sistema.id}`).removeClass('container-desktop'); 

	}
	else
	{
		if(role_main == 'sistema')
			$(`#${main_sistema.id}`).addClass('container-desktop'); 
		
		$(`#${nav_desktop.id}`).css({'display':'flex'});
		$(`#${nav_mobile.id}`).css({'display':'none'}); 
	}

})

Mobile.then(retorno=>{});
