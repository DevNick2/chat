/*
*
*	Arquivo responsável pelas configurações dos redirecionamentos e carregamentos de paginas
*
*/

let Redirect = function(url)
{
	window.location=url;
}

let BoxLoading = function()
{

	let html = `				
				<div id="carregamento">
					<div class="background-loading"></div>
					<div class="loading">
						<div class="loader"></div>
						<div class='progress' id="progress_div">
							<div class='bar' id='bar1'></div>
							<div class='percent' id='percent1'></div>
						</div>
						<input type="hidden" id="progress_width" value="0">
					</div>
				</div>
				`;

	return html;
}


export {BoxLoading, Redirect};
