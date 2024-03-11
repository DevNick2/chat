export default async function Session(route) {

    let result;

    try {
        result = await $.ajax({
            type: "POST",
			url: route,
			dataType:"json",
			data: {'sessao':true},
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
