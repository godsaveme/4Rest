

     <?php $parametro = $_GET['mesa_id'];?>
     <?php $parametro2 = $_GET['mesa_nombre'];?>
      <div class="row">
        <div class="large-12 columns">
          <br>
{{$parametro}}

				<ul>
					@foreach ($familias as $familia) 
						<li>{{$familia->nombre}}</li>
					@endforeach
				</ul>

								<ul>
					@foreach ($tipocomb as $tipocomb) 
						<li>{{$tipocomb->nombre}}</li>
					@endforeach
				</ul>

        </div>
      </div>