@extends('layouts.pedidosmaster')
@section('nombremesa')

@stop
@section('mesas_bar')
	@foreach($salones as $salon)
                    <li><label>{{$salon->nombre}}</label></li>
                <?php $mesas = Mesa::whereraw('salon_id='.$salon->id.' and habilitado=1')->get(); ?>
                   @foreach ($mesas as $mesa) 
                   <li>
                    <?php
                  $i=$mesa->estado;
                  $color="";
                    switch ($i) {
                       case "L":
                             $color="white";
                             break;
                       case "O":
                             $color="red";
                             break;
                       case "R":
                             $color="yellow";
                             break;
                       default: 
                          $color="white";
                          break;
                    }
                ?>
                      <!--<span style="display:block; position: left; height: 15px; width: 15px; background-color: {{$color}};"></span>-->
                   <a href="javascript:void(0)" class="btnClickMesa" style="color: {{$color}}" data-id="{{$mesa->id}}" data-nombre="{{$mesa->nombre}}">{{$mesa->nombre}}</a>
                  </li>
                   @endforeach 
              @endforeach
@stop


@section('main_section')
<div>
	<?php $arrayNC = array(); ?>
	@foreach($combinaciones as $NC)
		<?php 
				$arrayNC[] = array($NC->TipoCombinacionId, $NC->TipoCombinacionNombre);
		?>
	@endforeach
 	<!--Para ver si hay combinaciones disponibles .. Con TipoCombinacion-->
	<?php 
	if (isset($arrayNC)) {
		$listaNC_ = array_map("unserialize", array_unique(array_map("serialize", $arrayNC)));
		$listaNC = array_values($listaNC_);
	}
	$combStrings = array();
	$combNumbersNoUniq = array();
	?>
	<!-- Consulta para ver los productos de familia y combinaciones de un pedido . Odp= obj det pedido -->
@if (isset($Odp))
@if (count($Odp)>0)
										
			@foreach ($Odp as $fodp) 
				@if ($fodp->combinacion_id != '') 
					<?php  $combNumbersNoUniq[] = array($fodp->combinacion_id, $fodp->combinacion_c); ?>
				@endif
			@endforeach							


	@if (isset($combNumbersNoUniq))
	
	<?php 
	$combNumbers = array_map("unserialize", array_unique(array_map("serialize", $combNumbersNoUniq)));
	$combNumbersV = array_values($combNumbers);
	 ?>
		@for ($i=0; $i < count($combNumbersV); $i++)
			@if (isset($combNumbersV[$i]))
				<!--Llenar el tooltip de la combinacion-->
				@foreach ($Odp as $fodp) 
					@if ($fodp->combinacion_id == $combNumbersV[$i][0] && $fodp->combinacion_c == $combNumbersV[$i][1])
						@if (!isset($combStrings[$i])) 
						<?php  $combStrings[$i] = '';?> 
						@endif
						<?php  $combStrings[$i] .= '<div data-tipo ="c" data-estado="'.$fodp->estado.'" data-iddetped="'.$fodp->iddetped.'" class="itemcombinación '.$fodp->estado.'">|'.$fodp->nombre.' |</div>'; ?>
					@endif
				@endforeach
								
			@endif
		@endfor
	@endif

@endif
@endif
<!--    <div class="row"> -->

   			<div class="hide _id_ped_">{{$Opedido->id}}</div>
			<div class=" small-6 medium-6 large-6 columns">
				<div class="panel radius clearfix" style="display: none">
					   @foreach ($Opedido->mesas as $mesas)
					   <p class="right" style="display:none"><strong style="">Sucursal:</strong> Kango 01. Elias Aguirre #561. Chiclayo.</p>
					   <div id="cocinas" style="display:none;" class="small-6 medium-6 large-6 columns right">
					   </div>
							<h4 class="" style="display:none"><strong data-idpe="{{$Opedido->id}}" data-idmesa="{{$mesas->id}}" id="mesa_">{{$mesas->nombre}}</strong></h4>
							<h5 style="display: none;">Mozo: Ramiro Córdova Ochoa.</h5>
					   @endforeach
					   		<p style="display:none">Cantidad en la Cesta: <span class="strong NmrItms"></span> Item(s).</p>
				</div>
						<ul class="pricing-table">
								  <li class="title">Cesta de Pedidos</li>
								  <li class="bullet-item">
								  	<div id="prd_cesta">
								  		<?php $varID = '';
								  				$varC = '';
								  				$c = 0;
								  		 ?> 
								  		 <!--Validar mejor esto. Guardar en un array las combinaciones ya iteradas por si el detallepedido sale desordenado-->
								  @if(isset($Odp))		 
								  	@foreach ($Odp as $fodp) 
										@if ($fodp->combinacion_id != '')
												@if($varID != $fodp->combinacion_id || $varC != $fodp->combinacion_c)

														<!--hacer el llenado-->
														
														<?php $nombre_comb = DB::table('combinacion')->where('id',$fodp->combinacion_id)->select('nombre')->first(); ?>

							<?php $precio_comb = DB::select('select sum(x.valor) as PrecioTotalComb from (select  sum(distinct precio.precio*precio.cantidad) as valor from combinacion inner join precio
										on precio.combinacion_id = combinacion.id inner join producto
										on producto.id = precio.producto_id inner join familia
										on familia.id = producto.familia_id
								where combinacion.id = ?
								group by familia.id) as x', array($fodp->combinacion_id)); 

								$precio_comb2 = '';
								foreach ($precio_comb as $pc) {
									$precio_comb2 = $pc->PrecioTotalComb;
								}

								$precio_comb3 = $precio_comb2*$fodp->combinacion_cant;
								//var_dump($precio_comb->PrecioTotalComb);
								?>
														
					<div class="row" >
	       	 		<div class="novisible" data-enviado="1" data-idpedido ="{{$fodp->pedido_id}}" 
	       	 			id="{{$fodp->pedido_id}}_{{$fodp->combinacion_c}}"></div>
	       	 		<div data-tooltip data-options="disable_for_touch:false" class="small-1 medium-1 large-1 columns " title="{{$nombre_comb->nombre}}">{{$fodp->combinacion_cant}}</div>
	       	 			<div class="small-7 medium-7 large-7 columns">
	       	 				{{$combStrings[$c]}}
	       	 			</div>
	       	 			<div class="small-2 medium-2 large-2 columns montoTotal">S/. {{ number_format($precio_comb3,2)}}</div> 
	       	 			<div class="small-1 medium-1 large-1 columns">+</div>
	       	 			<div class="small-1 medium-1 large-1 columns">&times;</div>
	       	 		</div>
	       	 		<?php $c++; ?>

												@endif
													<?php $varID = $fodp->combinacion_id;
													$varC = $fodp->combinacion_c;
													 ?>
										@elseif ($fodp->combinacion_id == '')
											<div class="row {{$fodp->estado}}">
        	<div class="novisible" data-enviado="1" data-estado="{{$fodp->estado}}" data-iddetped="{{$fodp->iddetped}}"></div>
        	<div class="small-1 medium-1 large-1 columns">{{$fodp->cantidad}}</div>
        	<div class="small-7 medium-7 large-7 columns">{{$fodp->nombre}}</div>
        	<div class="small-2 medium-2 large-2 columns montoTotal">S/.{{$fodp->importeFinal}}</div>
        	<div class="small-1 medium-1 large-1 columns">+</div>
        	<div class="small-1 medium-1 large-1 columns">&times;</div>
        	</div>

										@endif
								  	@endforeach
								  	@endif
								  	<script type="text/javascript"></script>

									  </div>
									</li>
									<li id="montoTotal" class="price"></li>
						</ul>
			</div>


 			 <div class="small-6 medium-6 large-6 columns">
 			 	
						<dl class="tabs" data-tab>
								@foreach ($familias as $familia) 
								  <dd><a href="#panel2-f{{$familia->id}}">{{$familia->nombre}}</a></dd>
								@endforeach

							@if(isset($listaNC)) <!--Para ver si hay combinaciones disponibles-->

									@for ($i=0; $i < count($listaNC); $i++) 
								
									<dd><a href="#panel2-c{{$listaNC[$i][0]}}">{{$listaNC[$i][1]}}</a></dd>
								  	@endfor

							@endif

						</dl>
						<div class="tabs-content">
							@foreach ($familias as $familia) 
								  <div class="content" id="panel2-f{{$familia->id}}">
								  	<?php $new_fam = Familia::find($familia->id); ?>
									<!-- Productos de la familia x... -->
									<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
								  	@foreach ($new_fam->productos as $prodXfam)

								  	<?php $prec = DB::Select('SELECT precio.precio FROM precio INNER JOIN combinacion on precio.combinacion_id = combinacion.id where combinacion.nombre = ? and precio.producto_id = ? ' , array( 'Normal' , $prodXfam->id ) ); 

								  	//print_r($precio);
								  	$precio = "";
								  	foreach ($prec as $key) {
								  		$precio = $key->precio;
								  	}
								  	//die();

								  	?> 
									@if($precio != '')
												<li>
													<div class="hasAdc hide" >{{$prodXfam->lista_prod}}</div>
													<div class="row">
														<div class="large-12 columns">
										    			<img prd-id="{{$prodXfam->id}}" data-ped="{{$Opedido->id}}" class="btnAgregarPedidosCesta th" src="../../images/productos/shake.jpg">
										    			</div>
													</div>
													<div class="row">
													<div class="large-12 columns">
														{{Form::text('precio', $precio , array( 'id' => 'prd_precio_'.$prodXfam->id, 'prd-prec' => $precio , 'readonly' ) )}}
										    		</div>
										    		</div>
													<div class="row">
													<div id= "prd_nombre_{{$prodXfam->id}}" data-nombre="{{$prodXfam->nombre}}" class="large-12 columns">
										    		{{$prodXfam->nombre}} </div> 

										    		<div class="">
										    		<input style="display: none;" name="cantidad" type="number" id="prd_cantidad_{{$prodXfam->id}}" min="1" value="1"> 
										    		</div>

										    		</div>


										    	</li>
									@endif	    	

								    @endforeach
								</ul>
								  </div>
							@endforeach
						@if(isset($listaNC)) <!--Para ver si hay combinaciones disponibles-->
							@for ($i=0; $i < count($listaNC); $i++)
								<?php $cabs = array(); ?>
								@foreach ($combinaciones as $NC)
									@if ($NC->TipoCombinacionId == $listaNC[$i][0] && !in_array($NC->CombinacionId,$cabs))
									<div class="content" id="panel2-c{{$listaNC[$i][0]}}">								 
									<div class="row"> {{Form::button($NC->CombinacionNombre, array('class' => 'button radius btnMakeComb' , 'data-nc' => '', 'data-ped' => $Opedido->id , 'data-ic' => $NC->CombinacionId ))}} 
									</div>
									</div>
									
									@endif
									<?php $cabs[] = $NC->CombinacionId; ?>
								@endforeach
								<?php $cabs = 0; ?>
							@endfor
						@endif
						</div>
			<!--Modal de MAKE COMB-->
							<div id="makeOrder" class="reveal-modal" data-reveal>
							</div>
			<!--FIN MODAL-->
			<!--Modal de Cancelar Pedido-->

							<div id="CnlrPd" class="reveal-modal" data-reveal>
					
							</div>
			<!--FIN MODAL-->
					

 			 </div>
 			 
<!--    </div> -->



</div>
@stop
   


<style type="text/css">
	
	.novisible{
		display: none;
	}

	.enviado_color{
		background-color:#dddddd; 
		height: 15px;
	}
</style>

@section
	<script type="text/javascript">
      $(document).foundation();
    </script>
@stop