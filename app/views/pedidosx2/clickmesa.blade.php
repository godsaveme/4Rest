     <h3>Opciones de Mesa</h3>
     <p></p>
     <a class="close-reveal-modal">&#215;</a>

     <p>
     @if ($Omesa->estado == 'L' || $Omesa->estado =='R')
     
        <button id="btnAbrirMesa" data-id-mesa={{$Omesa->id}} class="radius button">Abrir</button>
		<button class="radius button btnCancelarModalClickMesa">Cancelar</button>
     
     @elseif ($Omesa->estado == 'O')
        <button id="btnCargarMesa" data-id-mesa={{$Omesa->id}} class="radius button">Cargar</button>
        <button id="btnMoverMesa" class="radius button">Mover</button>
        <button id="btnPreCuenta" class="radius button">Pre-cuenta</button>
        <button class="radius button btnCancelarModalClickMesa">Cancelar</button> 
     @endif
     </p>

