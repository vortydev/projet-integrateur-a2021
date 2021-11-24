<?php
function loadClass($className) {
   require_once './class/class' . $className . '.php';
}
spl_autoload_register('loadClass');
?>