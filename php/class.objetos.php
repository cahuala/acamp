<?php
class site
{
    function registaLog($instrucao,$user,$obs="")
    {
        global $conn,$adminClass,$dataAtual;
        $char_pesq=array("'",'"');
        $char_replace=array("\'",'\"');
        $instrucao=str_replace($char_pesq,$char_replace,$instrucao);
        $conn->query("insert into registoLog (user, instrucao,obs) values ('".$user."', '".$instrucao."', '".$obs."')");
        //echo "insert into registoLog (user, instrucao,obs) values ('".$user."', '".$instrucao."', '".$obs."')";
    }

   
    function noptcharset($string)
    {
        return strtr(strtolower($string), array( 
          "À" => "A", 
          "È" => "E", 
          "Ì" => "I", 
          "Ò" => "O", 
          "Ù" => "U", 
          "Á" => "A", 
          "É" => "E", 
          "Í" => "I", 
          "Ó" => "O", 
          "Ú" => "U", 
          "Â" => "A", 
          "Ê" => "E", 
          "Î" => "I", 
          "Ô" => "O", 
          "Û" => "U", 
          "Ç" => "C",
          "Ã" => "A",
          "Õ" => "O",
          "à" => "a", 
          "è" => "e", 
          "ì" => "i", 
          "ò" => "o", 
          "ù" => "u", 
          "á" => "a", 
          "é" => "e", 
          "í" => "i", 
          "ó" => "o", 
          "ú" => "u", 
          "â" => "a", 
          "ê" => "e", 
          "î" => "i", 
          "ô" => "o", 
          "û" => "u", 
          "ç" => "c",
          "ã" => "a",
          "õ" => "o",
          
        ));
    }
    function lowerLatino($string)
    { 
      return strtr(strtolower($string), array( 
          "À" => "à", 
          "È" => "è", 
          "Ì" => "ì", 
          "Ò" => "ò", 
          "Ù" => "ù", 
          "Á" => "á", 
          "É" => "é", 
          "Í" => "í", 
          "Ó" => "ó", 
          "Ú" => "ú", 
          "Â" => "â", 
          "Ê" => "ê", 
          "Î" => "î", 
          "Ô" => "ô", 
          "Û" => "û", 
          "Ç" => "ç",
          "Ã" => "ã",
          "Õ" => "õ", 
        )); 
    }
    function upperLatino($string)
    { 
      return strtr(strtoupper($string), array( 
          "à" => "À", 
          "è" => "È", 
          "ì" => "Ì", 
          "ò" => "Ò", 
          "ù" => "Ù", 
          "á" => "Á", 
          "é" => "É", 
          "í" => "Í", 
          "ó" => "Ó", 
          "ú" => "Ú", 
          "â" => "Â", 
          "ê" => "Ê", 
          "î" => "Î", 
          "ô" => "Ô", 
          "û" => "Û", 
          "ç" => "Ç",
          "ã" => "Ã",
          "õ" => "Õ", 
        )); 
    }
    function tornarSegura($s)
    {
        return strip_tags(trim($s));
    }
    
    function encryptar ($string, $chave)
    {
        $output = false;
         $encrypt_method = "AES-256-CBC";
         //$secret_key = 'WS-SERVICE-KEY';
         $secret_iv = 'WS-SERVICE-VALUE';
         // hash
         $key = hash('sha256', $chave);
         // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
         $iv = substr(hash('sha256', $secret_iv), 0, 16);
         $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
         return $output;
        
    }
    function desencryptar ($string, $chave)
    {
        $output = false;
         $encrypt_method = "AES-256-CBC";
         //$secret_key = 'WS-SERVICE-KEY';
         $secret_iv = 'WS-SERVICE-VALUE';
         // hash
         $key = hash('sha256', $chave);
         // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
         $iv = substr(hash('sha256', $secret_iv), 0, 16);
         $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
         return $output;
    }
   
}