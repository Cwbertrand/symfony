
$(document).ready(function() {
    $(document).on('change', '#flags', function() {
        $.ajax({ 
            type: 'POST', 
            url: $('#flags').data('path'), 
            dataType: 'json',
            data: { 'code': $('#flags option:selected').val() },
            async: true,
            success: function(data)
            { 
                console.log(data);
                if (data == true) {
                    location.reload();
                }
            } 
        });
    });

    const form = document.querySelector('#shortenForm');
    const ShortenCard = document.querySelector('#shortenCard');
    const InputUrl = document.querySelector('#url-ajax-shorten');
    const btnUrl = document.querySelector('#submitUrl');

    const URL_SHORTEN = '/ajax/shorten';
    let url = document.getElementById('url-ajax-shorten');

    $('#submitUrl').click(function() { 
        $.ajax({ 
            type: 'POST', 
            url: URL_SHORTEN  , 
            dataType: 'json',
            data: {'url':url.value},
            async: true,
            success: function(data)
            { 
                if(data.statusCode == 200){
                    window.location.href = data.long_url;
                }
                if(data.statusCode == 400 || data.statusCode == 500){
                    const alert = document.createElement('div');
                    alert.classList.add('alert', 'alert-danger', 'mt-2');
                    alert.innerText = $('#error-url-ajax-shorten').text(data.statusText);
                }
            } 
        });
    });



/*btnUrl.addEventListener('click', function(){
    
    let url = document.getElementById('url-ajax-shorten');
    // fetch(URL_SHORTEN, {
    //     method: 'POST',
    //     body: {
    //         'url': url.value
    //     }

    // })

    // .then(response => response.json())
    // .then(handleData)

    
    const user = {
        url: url.value
    };
    
    const options = {
        method: 'POST',
        body: JSON.stringify(user),
        headers: {
            'Content-Type': 'application/json'
        }
    }
    
    fetch(URL_SHORTEN, options)
        .then(res => res.json())
        .then(res => console.log(res));
});

const handleData = function(data) {
    console.log(data);
}*/


});

