    var app = new kendo.mobile.Application(document.body, { skin: 'ios6'
/*        ,

        init: function() {
            setTimeout(function() {
                kendo.fx(".splash").fadeOut().duration(700).play();
            }, 0)
        }*/
    });


$(function(){
	/*Inicializar elementos de KEndo*/
	var PBC = $("#PanelBarCesta").kendoPanelBar({
		expandMode: "single",
		mobile: "phone",
		height: kendo.support.mobileOS.wp ? "24em" : 430,
		animation: {
			expand: {	        	 	
				effects: false
			},
			collapse:{
				effects: false
			}
		}


	});

	$("#sortable-handlers").kendoSortable({
		mobile: "phone",
		height: kendo.support.mobileOS.wp ? "24em" : 430,
		handler: ".handler",
		hint:function(element) {
			return element.clone().addClass("hint");
		}
	});





	/*FIN Inicializar elementos de KEndo*/

});