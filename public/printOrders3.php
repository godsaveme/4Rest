<?php require_once(dirname(__FILE__) . "/../app/escpos/Escpos.php");
							$printer = new Escpos();
						    $printer -> text("Pasteleria\n");						    
						    $printer -> text("Fecha: 01-07-2015 / Hora: 10:31:55\n");
						    $printer -> text("Mesa:		Mesa 20\n");
						    $printer -> text("Mozo:		brunello\n");
						    $printer -> text("---------------------------------\n");
						    $printer -> text("Cant.					Descripción\n	");
						    $printer -> text("---------------------------------\n");$printer -> text("2   Pastel de Choclo porción\n");$printer -> text(" 	");$printer -> text(" /holi");$printer -> text("\n");$printer -> text("2   Pastel de Choclo porción\n");$printer -> text(" 	");$printer -> text(" /prod nuevo probar");$printer -> text("\n");$printer -> text("---------------------------------\n");$printer -> cut();$printer -> close();