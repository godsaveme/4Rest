<?php require_once(dirname(__FILE__) . "/../app/escpos/Escpos.php");
							$printer = new Escpos();
							$printer -> feed();
							$printer -> feed();
							$printer -> setJustification(Escpos::JUSTIFY_CENTER);
							$printer -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
						    $printer -> text("Barra\n");
						    $printer -> selectPrintMode();
							$printer -> setJustification(Escpos::JUSTIFY_LEFT);
						    $printer -> text("Fecha: 13-11-2015 / Hora: 19:28:21\n");
						    $printer -> text("Mesa:  Mesa 08\n");
						    $printer -> text("Mozo:  Caja\n");
						    $printer -> text("------------------------------------------------\n");
						    $printer -> text("Cant.      Descripción\n");
						    $printer -> text("------------------------------------------------\n");$printer -> text("X1   Coca Cola\n");$printer -> text("------------------------------------------------\n");$printer -> cut();$printer -> close();