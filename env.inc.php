<?php
require_once 'SplClassLoader.php';

$ClassLoader=new SplClassLoader('JasonKaz\FormBuild', '/vendor');
$ClassLoader->register();
?>