<?php require_once(dirname(__FILE__) . "/../app/escpos/Escpos.php");
							$printer = new Escpos();
							$printer -> text("Pre Cuenta\n");
							$printer -> feed();
							$printer -> text("---------------------------------------");
							$printer -> text("Descripción 	P.Unit.	   Cant. 	Subt.");
							$printer -> text("---------------------------------------");$printer -> text("Frappe Mokac.	10.90		X2	21.80");$printer -> text("Chocolate Ka.	6.90		X4	27.60");$printer -> text("Te Frutado c.	3.90		X2	7.80");$printer -> text("Brg. Parrill.	12.90		X2	25.80");$printer -> text("Bgr. Frenchi.	12.90		X3	38.70");$printer -> text("Pastel de Ch.	6.00		X4	24.00");$printer -> text("Total");$printer -> text("S/.145.70\n");$printer -> feed();$printer -> text("Mesa Atendida: Mesa 20\n");$printer -> text("Mozo: brunello\n");$printer -> text("---------------------------------\n");$printer -> text("Fecha: 01-07-2015 10:34:32\n");$printer -> text("<<No válido como documento contable>>\n");$printer -> cut();$printer -> close();