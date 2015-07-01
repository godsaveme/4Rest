<?php require_once(dirname(__FILE__) . "/../app/escpos/Escpos.php");
							$printer = new Escpos();
						    $printer -> text("Barra\n");						    
						    $printer -> text("Fecha: 01-07-2015 / Hora: 11:17:41\n");
						    $printer -> text("Mesa:		Mesa 20\n");
						    $printer -> text("Mozo:		brunello\n");
						    $printer -> text("---------------------------------\n");
						    $printer -> text("Cant.					Descripción\n	");
						    $printer -> text("---------------------------------\n");$printer -> text("1   Helado Simple\n");$printer -> text("	");$printer -> text(" >Café");$printer -> text("\n");$printer -> text(" 	");$printer -> text(" /fresa");$printer -> text(" /MANIAKO ");$printer -> text("\n");$printer -> text("---------------------------------\n");$printer -> cut();$printer -> close();