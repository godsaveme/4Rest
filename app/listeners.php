<?php
Event::listen('imprimirpedidos', 'Impresioneshandler@imprimirpedidos');
Event::listen('imprimirreportediariocaja', 'Impresioneshandler@imprimirreportediariocaja');
Event::listen('imprimirticket', 'Impresioneshandler@imprimir_ticketcaja');