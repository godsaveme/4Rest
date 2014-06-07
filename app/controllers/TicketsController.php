<?php

class TicketsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /tickets
	 *
	 * @return Response
	 */
	
	public function getShow($id){
		if(isset($id)){
			$ticket = Ticket::find($id);
			$detalles = $ticket->detallest;
			$tipodepago = '';
			return View::make('tickets.show', compact('ticket', 'detalles'));
		}else{
			return Redirect::to('/web');
		}
	}

}