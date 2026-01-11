<?php
session_start();

session_unset();
session_destroy();
echo"<script>
                                                                                                                                 
    if ( window.history.replaceState ) {
                                                                                                                                  
         window.history.replaceState( null, null, window.location.href );
                                                                                                                                 
     }                                                                                                                   
 </script>";
header("Location: login.php");
exit;
?>
