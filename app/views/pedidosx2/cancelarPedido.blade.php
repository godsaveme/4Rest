<a class="close-reveal-modal">&#215;</a>
<div class="row">
	<div class="small-6 medium-6 large-6 columns">
		<h4>Check Out:: Pedido N° {{$Opedido->id}}</h4>
		<?php $mesa = $Opedido->mesas()->first(); ?>
		<p><strong>{{$mesa->nombre}}</strong></p>
		<input type="hidden" id="hdnMesaId" value={{$mesa->id}}>
		<p>Mozo: Ramiro Córdova Ochoa.</p>
		<ul class="button-group">
		  <li><a href="#" id="btnCntd" class="button ">Cash</a></li>
		  <li><a href="#" id="btnTrjt" class="button">Tarjeta Visa</a></li>
		  <li><a href="#" id="btnVl" class="button">Vale</a></li>
		</ul>
		<div class="row">
		  <div class="small-5 medium-5 large-5 columns">Total a Pagar: S/.</div>
		  <div class="small-7 medium-7 large-7 columns"><input type="text" id="InptPagar" readonly value="{{$mnttl}}"></div>
		</div>
		<div class="row">
		  <div class="small-5 medium-5 large-5 columns">Total Pagado: S/.</div>
		  <div class="small-7 medium-7 large-7 columns"><input type="text" id="InptPagado" readonly value=""></div>
		</div>
		<div class="row">
		  <div class="small-5 medium-5 large-5 columns">Vuelto: S/.</div>
		  <div class="small-7 medium-7 large-7 columns"><input type="text" id="InptVuelto" readonly value=""></div>
		</div>
		<button id="btnCheckOut" data-ped="{{$Opedido->id}}" class="alert button right">Check Out</button>

	</div>
	<div class="small-6 medium-6 large-6 columns">
			<div class="row">
			  <div class="small-12 medium-12 large-12 columns"><input class="text-right InptRslt" type="number" min="0" value="0" readonly></div>
			</div>	
			<div class="row">
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">7</button></div>
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">8</button></div>
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">9</button></div>
			</div>
			<div class="row">
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">4</button></div>
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">5</button></div>
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">6</button></div>
			</div>
			<div class="row">
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">1</button></div>
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">2</button></div>
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">3</button></div>
			</div>
			<div class="row">
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">0</button></div>
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">.</button></div>
			  <div class="small-4 medium-4 large-4 columns"><button class="secondary expand btnCalc">Del</button></div>
			</div>
	</div>		

</div>

