<?php require_once(dirname(__FILE__) . "/../app/escpos/Escpos.php");
							$printer = new Escpos();
						    $printer -> text("Barra\n");						    
						    $printer -> text("Fecha: 01-07-2015 / Hora: 10:31:55\n");
						    $printer -> text("Mesa:		Mesa 20\n");
						    $printer -> text("Mozo:		brunello\n");
						    $printer -> text("---------------------------------\n");
						    $printer -> text("Cant.					Descripción\n	");
						    $printer -> text("---------------------------------\n");$printer -> text("2   Te Frutado c/Limon\n");$printer -> text(" 	");$printer -> text(" /1 tibio y 1 calienteeeeeee");$printer -> text("\n");$printer -> text("4   Chocolate Kango\n");$printer -> text(" 	");$printer -> text(" /vaso de chicha");$printer -> text("\n");$printer -> text("2   Frappe Mokachips\n");$printer -> text(" 	");$printer -> text(" /todo para llevar");$printer -> text(" /krasher oreo");$printer -> text("\n");$printer -> text("---------------------------------\n");$printer -> cut();$printer -> close();