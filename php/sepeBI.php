<?php
      if($_REQUEST['bi']) $bi=$_REQUEST['bi'];
 
     $url="https://www.sepe.gov.ao/ao/actions/bi.ajcall.php?bi=$bi";
     $ch=curl_init($url);
     $resultado = json_decode(curl_exec($ch));

     if(($resultado) and $resultado !=0 ){
        $retorno =['status'=>true,'dados'=>$resultado];
     }else{
        $retorno =['status'=>false,'msg'=>"O BI Inserido não existe!"];
     }
?>

