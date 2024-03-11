import Tunnel from './../Promises/Tunnel';
import Session from './../Promises/Session';

let modal_onboarding = $('#onboarding')

Tunnel('public').then(path=>{
    Session(`${path[0]}Sessao`).then(result=>{
        if(result == false)
            window.location = `${path[0]}`; 
        
            modal_onboarding.find('#nome-onboard').text(result)        
    }); 

    modal_onboarding.find('#desabilitar-guia').on('click', function()
    {
        $.ajax({
            type: "POST",
            url: `${path[0]}DesabilitarGuia`,
            dataType:"json",
            data: {'action':true,},
            beforeSend: function()
            {               
                modal_onboarding.find('#loading-login').css({'display':'inline-flex'});
            },
            complete: function()
            {
                 modal_onboarding.find('#loading-login').css({'display':'none'});                    
            },
            success: function(data)
            {
                console.log(data)                           
                $('#BoxAlertSuccess').addClass('box-alert-active').text(data);

                setTimeout(function()
                {
                    $('#BoxAlertSuccess').removeClass('box-alert-active').text('');
                },5000);            
            },
            error: function(request)
            {
                console.log(request.responseText);
                $('#BoxAlertError').addClass('box-alert-active').text(request.responseText);

                setTimeout(function()
                {
                    $('#BoxAlertError').removeClass('box-alert-active').text('');
                },5000);
            }
        });
    });

    $.ajax({
            type: "POST",
            url: `${path[0]}StatusGuia`,
            dataType:"json",
            data: {'action':true,},
            success: function(data)
            {
                if(data[0] == '1' && data[1] == 'comum')
                    modal_onboarding.modal('show');
            },
            error: function(request)
            {
                console.log(request.responseText);
                $('#BoxAlertError').addClass('box-alert-active').text("Não foi possível carregar o GUIA");

                setTimeout(function()
                {
                    $('#BoxAlertError').removeClass('box-alert-active').text('');
                },5000);
            }
        });
})