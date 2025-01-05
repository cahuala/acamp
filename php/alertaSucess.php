<?php
//include "includes/configuracoes.php";
/**
 *@author CAHUALA 934903730
 * @copyright 15/02/2025
 * @project EXCURSÃo MARAVILHA
 */

  if (isset($_SESSION['msg'])) {
    if( $_SESSION['msg']!=''){
 
   ?> 
<script>
  Swal.fire({
  title: "Bom Trabalho!",
  text: "<?php echo $_SESSION['msg']; ?>",
  icon: "success"
}).then((result) => {
        if (result.isConfirmed) {
            window.location = "<?php $_SESSION['url'] ?>"
        }
    });
</script>

<?php
    }
}

unset($_SESSION['msg']);

?>

