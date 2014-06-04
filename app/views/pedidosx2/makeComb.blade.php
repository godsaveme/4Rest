<?php $precio_tot; ?>
@foreach ($prod_fam as $PF)
<?php $precio_tot[$PF->FamiliaId] = $PF->ProductoPrecio*$PF->PrecioCantidad; ?>
	
@endforeach

<?php 
	//var_dump($precio_tot);
	//die();
$listaPT = array_unique($precio_tot);
 $precio_var = 0;
 ?>

 @foreach ($precio_tot as $key => $value)
	<?php $precio_var += $value;

	 ?>
 @endforeach

 <?php $precio_var = number_format($precio_var,2); ?>

<div style="background-color:white;" class="row"  data-equalizer>
  <div class="small-6 medium-6 large-6 columns">


							<?php $fam_id_repeat = array();?>
							<?php $fam_id_repeat2 = array();?>
							<?php $arrayFN; ?>
							<?php $lala = 0; ?>
							<?php $arrayLala; ?>
							<?php $cabs = array(); ?>
							@foreach ($prod_fam as $PF)
									
									@if(!in_array($PF->FamiliaId,$fam_id_repeat))
									<div class="row">
										<div class="large-12 columns">
											<strong>{{$PF->FamiliaNombre}}</strong>
											<?php $arrayFN[] =  array($PF->FamiliaNombre,$PF->PrecioCantidad );


											?>
										</div>
									</div>
									@endif

									<ul class="button-group">
										<div id="fn_{{$PF->FamiliaNombre}}">
									
									@foreach ($prod_fam as $PF2)
									
										@if ($PF2->FamiliaNombre == $PF->FamiliaNombre && !in_array($PF2->FamiliaId,$fam_id_repeat))
											
											@if (!in_array($PF2->FamiliaId, $fam_id_repeat2))
												@for ($i=0; $i < $PF2->PrecioCantidad; $i++)
													<?php $lala = $lala + 1; ?>
													<?php $arrayLala[] = $lala; ?>
												@endfor
											@endif

											 <li><a data-lala="{{implode(',', $arrayLala)}}" pr-fn="{{$PF2->FamiliaNombre}}" pr-fi="{{$PF2->FamiliaId}}" pr-pr="{{$PF2->ProductoPrecio}}" pi-id="{{$PF2->ProductoId}}" pc-pc="{{$PF2->PrecioCantidad}}" pn-no="{{$PF2->ProductoNombre}}"
											  class="button tiny secondary mkSelec" >
											   {{$PF2->ProductoNombre}}</a></li>

											<?php $fam_id_repeat2[] = $PF2->FamiliaId; ?>
											   
									    @endif

									@endforeach
									<?php $arrayLala = NULL; ?>

										</div>
									</ul>

								  <?php $fam_id_repeat[] = $PF->FamiliaId; ?>
							@endforeach

<div class="row">
	<div class="small-4 medium-4 large-4 columns">
		{{Form::button('Order', array( 'id' => 'btnMakeOrder', 'class' => 'small expand button', 'data-ped' => $id_ped , 'data-price-tot' => $precio_var , 'data-id-comb' => $id_comb, 'data-nombre-comb' => $nomb_comb ))}}

			

	
	  </div>
	  <div class="small-8 medium-8 large-8 columns">
	  	<div class="row">
	  		<div class="small-6 medium-6 large-6 columns">
	  		<a href="#" class="button small alert mkPls" data-cnt-f={{count($arrayFN)}}>+</a>
	  		<a href="#" class="button small alert mkMns">-</a>
	  		</div>
	  		<div class="large-1 columns mkCnt">
	  			0
	  		</div>
	  		<div class="small-5 medium-5 large-5 columns">
	  			
	  		</div>
	  	</div>

	  </div>
</div>



		</div>	


  <div class="small-6 medium-6 large-6 columns">

  		<table> 
  				<thead>
  					 <tr class="zov33">
  					 	 @for ($i=0; $i < count($arrayFN); $i++)
  					 	 	@for ($j=0; $j < $arrayFN[$i][1]; $j++) 
  					 	 		<th width="">{{$arrayFN[$i][0]}}</th>
  					 	 	@endfor
  					 	 @endfor
  					 </tr>
  				</thead>
  				<tbody class="zov34">

  				</tbody>
  		</table>

  </div>
</div>



