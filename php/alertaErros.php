<?php
//include "includes/configuracoes.php";
/**
 *@author CAHUALA 934903730
 * @copyright 15/02/2025
 * @project EXCURSÃo MARAVILHA
 */
//print_r($_SESSION);
if(isset($_SESSION['error']) && $_SESSION['error'] != '')
{
  
   ?> 
<script>
  Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "<?php echo $_SESSION['error']; ?>"
});
</script>

<?php
}

unset($_SESSION['error']);

?>

