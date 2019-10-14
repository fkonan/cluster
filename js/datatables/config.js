function iniciarTabla()
{
	$('#tabla').DataTable({
        paging:true,
        searching:true,
       
        /*
        "language":
        {
            "decimal":        "",
            "emptyTable":     "No hay datos",
            "info":           "Mostrando _START_ a _END_, Total: _TOTAL_ registros",
            "infoEmpty":      "Mostrando 0 de 0 de 0 registros",
            "infoFiltered":   "(filtrado para _MAX_ total de registros)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu": "Display _MENU_ records",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",  
            "search":         "Buscar:",    
            "zeroRecords":    "No se han encontrado registros",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "aria": {
                "sortAscending":  ": activar para ordenar la columna ascendentemente",
                "sortDescending": ": activar para ordenar la columna descendentemente"
            },
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
            "pageLength": 50
        },
        */
    });
} 