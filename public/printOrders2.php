<?php require_once(dirname(__FILE__) . "/../app/escpos/Escpos.php");
							$printer = new Escpos();
							$printer -> feed();
							$printer -> feed();
							$printer -> setJustification(Escpos::JUSTIFY_CENTER);
							$printer -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
						    $printer -> text("Barra\n");
						    $printer -> selectPrintMode();
							$printer -> setJustification(Escpos::JUSTIFY_LEFT);
						    $printer -> text("Fecha: 27-09-2015 / Hora: 18:31:01\n");
						    $printer -> text("Mesa:  Mesa 20\n");
						    $printer -> text("Mozo:  ivanG\n");
						    $printer -> text("------------------------------------------------\n");
						    $printer -> text("Cant.      Descripción\n");
						    $printer -> text("------------------------------------------------\n");$printer -> text("X1   Te Frutado c/Limon\n");$printer -> text("------------------------------------------------\n");$printer -> cut();$printer -> close();