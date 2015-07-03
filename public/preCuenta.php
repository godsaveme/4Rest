<?php require_once(dirname(__FILE__) . "/../app/escpos/Escpos.php");
							$printer = new Escpos();
							$printer -> text("Pre Cuenta\n");
							$printer -> feed();
							$printer -> text("---------------------------------------");
							$printer -> text("Descripción 	P.Unit.	   Cant. 	Subt.");
							$printer -> text("---------------------------------------");$printer -> text("Coca Cola***.	3.50		X1	3.50");$printer -> text("Agua S/Gas**.	2.50		X1	2.50");$printer -> text("ensalada cap.	3.00		X1	3.00");$printer -> text("Total");$printer -> text("S/.9.00\n");$printer -> feed();$printer -> text("Mesa Atendida: Mesa 07\n");$printer -> text("Mozo: ivanG\n");$printer -> text("---------------------------------\n");$printer -> text("Fecha: 03-07-2015 16:10:05\n");$printer -> text("<<No válido como documento contable>>\n");$printer -> cut();$printer -> close();