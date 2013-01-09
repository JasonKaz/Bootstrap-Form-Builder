<?php
require_once 'SplClassLoader.php';

$ClassLoader=new SplClassLoader('JasonKaz\FormBuild', '/vendors');
$ClassLoader->register();
?>