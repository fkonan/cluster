function alertMsg(title='', msg, type='success', duration=2000, btn=false){
/*
AlertMsg.msg = msg;
AlertMsg.duration = (typeof duration !== 'undefined')? duration : 5000;
AlertMsg.type = (typeof type !== 'undefined')? type : 'info';
AlertMsg.showAlert();
*/
// icon: "warning" "error" "success" "info" 
// button: "Coolio" button: false
   swal({
      title: title,
      text: msg,
      type: type,
      showConfirmButton: btn,
      showCancelButton: btn,
      timer: duration, 
      customClass: {
         container: 'my-zswal'
      }
   });

}

function validarAccion(title='¿Está seguro de realizar esta acción?', msg='El proceso no tendra reversa en caso de acerptar culminar esta acción.'){
   
   swal.fire({
     title: title,
     text: msg,
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#1ab394',
     confirmButtonText: 'Continuar'
   }).then((result) => {

      if (result.value) {
        rta = true;
      }else{
        rta = false;
      }
      
      alert(rta);

   }) 
   
}

function confirmaSalir(mensaje) {
    // <a href="../controllers/controladorFinca.php?op=eliminar&id='.$entrada['id_finca'].'" onClick="return confirmaEliminar(\'¿Desea eliminar la Finca?\');"
    var agree = confirm(mensaje);

    if (agree) {
        return true;
    } else {
        return false;
    }
}