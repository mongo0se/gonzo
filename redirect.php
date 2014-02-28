<?php

// Its a redirect script.


function redirect($url,$permanent = false)
{
  if($permanent)
  {
    header('HTTP/1.1 301 Moved Permanently');
  }
  header('Location: '.$url);
  exit();
}


?>