@extends('layouts.master')
 

 
@section('content')
<div class="container">
<div class="englobe">

                <p class="text-center"><img src="{{Request::root().'/images/productos/tostao_login.jpg'}}" alt=""/></p>
  	{{Form::open(array('url' => 'login', 'class' => 'form-signin' , 'role' => 'form', 'id' => 'login'))}}

    		<h3 class="form-signin-heading text-center" style="margin: 0px;">¡Bienvenido a 4Rest!</h3>
            <div class="sesion_msg text-center">
                
            
                        @if (Session::has('mensaje_login'))
                <strong class="text-danger bg-danger text-center" style="padding:15px;"><span style="color:white;"> {{ Session::get('mensaje_login') }}</span></strong>
                </br>
                @endif

                </div>


    		  	{{Form::label('login', 'Usuario:', array('style'=>'font-weight: normal;','for'=>'login'))}}
                {{Form::input('text', 'login', Input::old('login'),array('placeholder'=>'Ingrese usuario','class'=>'form-control','required','autofocus','style'=>'margin-bottom:10px;', 'validationMessage'=>'Por favor entre un usuario '))}}
                <div>
                    
                </div>

    		  	{{Form::label('password', 'Contraseña:',array('style'=>'font-weight: normal;','for'=>'password'))}}
    		  	{{ Form::password('password',array('class'=>'form-control','placeholder'=>'Password', 'required', 'validationMessage'=>'Contraseña es requerida')); }}
                <label class="checkbox">
                  <input name="remember" type="checkbox"> Recordar
                </label>

    		  	{{Form::submit('Login', array('class'=>'btn btn-lg btn-primary btn-block'))}}




    	{{Form::close()}}

</div>
</div>
@stop

@section('footer')
        <footer id="footer">
      <div class="container">
        <p class="cls-footer">®4Rest 2014. Todos los derechos reservados.</p>
      </div>
    </footer>
@show

@section('css')
{{HTML::style('css/newstyles/login.css')}}
@stop
@section('js')
    {{HTML::script('js/newjs/login.js'); }}
@stop


