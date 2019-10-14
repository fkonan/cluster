jQuery(function($){
	$('.table').footable({
		"paging": {
			"enabled": true,
			"size": 20,
			"countFormat": "{CP} de {TP}"
		},
		"sorting": {
			"enabled": true
		},
		"filtering": {
			"enabled": true,
			"placeholder": "Buscar",
			"dropdownTitle":"Campos para buscar",
			"container":"#data-filter-container"
		}
	});
});
 