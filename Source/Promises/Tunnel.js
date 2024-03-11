import aes from 'crypto-js/aes'
import encHex from 'crypto-js/enc-hex'
import padZeroPadding from 'crypto-js/pad-zeropadding'


export default async function Tunnel(destine) {
    let result;
    let route;
    let dados;

    let msg = "Open_Tunnel";
    let key = encHex.parse("0123456789abcdef0123456789abcdef");
    let iv =  encHex.parse("abcdef9876543210abcdef9876543210");
    let encrypted = aes.encrypt(msg, key, {iv:iv, padding:padZeroPadding}).toString();
 
    if(destine == 'public')
    {
    	route = '/Mark_2/OpenTunnelPublic';
        dados = {'chave': encrypted};
    }
    	
    if(destine == 'private')
    {
 		route = '/Mark_2/OpenTunnelPrivate';
        dados = {'open': true}
    }

    if(destine == 'ajuda')
    {
        route = '/Mark_2/OpenTunnelUsuario';
        dados = {'open': true}
    }

    try {
        result = await $.ajax({
            type: "POST",
			url: route,
			dataType:"json",
			data: dados,
			success: function(data)
			{	
				return data;
            },
            error: function(request)
            {
                return request.responseText;
			}     
        });

        return result;
    } catch (error) {
        console.error(error);
    }

}
