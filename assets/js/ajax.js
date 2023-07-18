$(document).ready(function ()
{
    $('#register').on('click',function (event)
    {
        event.preventDefault();
        const fd = new FormData(document.getElementById("FormReg"));

       // let avatar = document.getElementById("avatar")

        let email = $('#email').val();
        let username = $('#username').val();
        let password = $('#password').val();
        let pass_conf = $('#pass_conf').val();

        fd.append('email',email);
        fd.append('username',username);
        fd.append('password',password);
        fd.append('pass_conf',pass_conf);



        $.ajax
        ({
            method: "POST",
            processData: false,
            contentType: false,
            url: "../../app/Services/ajax.php", //
            data: fd

        })
            .done(function( msg )
            {
                console.log(msg);
               /* let message = jQuery.parseJSON(msg);

                if (message.key == "error")
                {
                    let html =  '<div class="alert alert-danger" role="alert">' + message.value + '</div>';
                    $('.msg').html(html);
                }else
                {
                    alert(msg);

                }*/



            });

    })

})