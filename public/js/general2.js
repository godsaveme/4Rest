function destroy(){
  var r = confirm("¿Realmente desea eliminar?");
    if(r==true){

    }else{
      event.preventDefault();
    }
}
$(function() {
	//console.log( $( '.show_ajax' ).serialize() );
var form = $('.show_ajax');
        form.bind('submit',function () {
            $.ajax({
                type: form.attr('method'),
                url: 'ajax',
                data: form.serialize(),
                beforeSend: function(){
                    //$('.before').append('<img src="imgs/350.gif" />');
                },
                complete: function(data){
                    
                },
                success: function (data) {
                	$('.email').html(data.email);
                	$('.username').html(data.username);
                	$('.password').html(data.password);
                    //$('.email').html($('#email').val());
                    //$('.username').html($('#username').val());
                    //$('.password').html($('#password').val());
                    /*if(data.success == false){
                        var errores = '';
                        for(datos in data.errors){
                            errores += '<small class="error">' + data.errors[datos] + '</small>';
                        }
                        $('.errors_form').html(errores)
                    }else{
                        $(form)[0].reset();//limpiamos el formulario
                        $('.success_message').show().html(data.message)
                    }*/
                },
                error: function(errors){
                    //$('.before').hide();
                    //$('.errors_form').html('');
                    //$('.errors_form').html(errors);
                }
            });
       return false;
    });


});
