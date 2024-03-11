var progress_width = 0;// iniciando o loading em zero

function AtivaElemento(element)
{
	let all = document.getElementsByTagName("*"); // Mapeando todos os elementos do dom
	let per_inc = 100/all.length; // dividindo o total de elementos por 100
	let bar1 = document.querySelector('#bar1') 
	
	if($(element).on())
	{
		let prog_width = per_inc+Number(progress_width);

		progress_width = prog_width;

		$(`#${bar1.id}`).animate(
			{width: prog_width + "%"},10, // inserindo a percentagem de width na barra
			function()
			{
				if(bar1.style.width == "100%") // Colocando a barra com width de 100%
				{
					$(`#carregamento`).fadeOut("slow");
				}			
			}
		);
	}
	else	
	{
		StartProgress(element);
	}
}

let StartProgress = function(set_element)
{	
	AtivaElemento(set_element);
}

export default StartProgress;
