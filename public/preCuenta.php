<?php require_once(dirname(__FILE__) . "/../app/escpos/Escpos.php");
							//$logo = new EscposImage("images/productos/tostao.jpg");
							$printer = new Escpos();
							/* Print top logo */
                            $printer -> setJustification(Escpos::JUSTIFY_CENTER);
                            //$printer -> graphics($logo);
							$printer -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
							$printer -> text("Pre Cuenta\n");
							$printer -> selectPrintMode();
							$printer -> setJustification(Escpos::JUSTIFY_LEFT);
							$printer -> feed();
							$printer -> text("------------------------------------------------\n");
							$printer -> text("Descripción      P.Unit.      Cant.       Subt.\n");
							$printer -> text("------------------------------------------------\n");$printer -> text("Jarra De Lim.    10.00        X  2         20.00\n");$printer -> text("Muchik Krash.    10.90        X  1         10.90\n");$printer -> text("Frappe Norte.    10.90        X  1         10.90\n");$printer -> text("Tequeños***.    13.00        X  1         13.00\n");$printer -> text("Brg. Parrill.    12.90        X  1         12.90\n");$printer -> text("Pollo a la p.     6.90        X  1          6.90\n");$printer -> text("ensalada cap.     3.00        X  1          3.00\n");$printer -> text("Fuente Cebic.    35.00        X  3        105.00\n");$printer -> text("------------------------------------------------\n");$printer -> text("Total de Items:  8\n");$printer -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);$printer -> setEmphasis(true);$printer -> text("Total  ");$printer -> text("S/.182.60\n");$printer -> feed();$printer -> selectPrintMode();$printer -> setEmphasis(false);$printer -> text("Mesa Atendida: Mesa 05\n");$printer -> text("Mozo: darwinsr\n");$printer -> text("------------------------------------------------\n");$printer -> text("Boleta[] Factura[] / Consumo[] Detall.[]\n");$printer -> text("Nombres/Rzon Soc.:______________________________\n");$printer -> text("Direcc.:________________________________________\n");$printer -> text("DNI/RUC.:_______________________________________\n");$printer -> feed();$printer -> text("Fecha: 13-07-2015 16:38:29\n");$printer -> text("<<No válido como documento contable>>\n");$printer -> cut();$printer -> close();