/*
*	Arquivo principal para configurações em nível de core
*/

import StartLoading from './Funcoes/ProgressBar';
import {BoxLoading, Redirect} from './Funcoes/Redirect';

// Carregamento da pagina
	$('body').append(BoxLoading()); // Injetando o box do loading no html
	document.onreadystatechange = function() // Analisando o status do DOM
	{
		console.log('carregou')
		if(document.readyState=="interactive")
		{
			let all = document.getElementsByTagName("*"); // Mapeando todos os elementos do dom
			for (let i=0, max=all.length; i < max; i++) 
			{
				StartLoading(all[i]);
			}
		}
	}
//
