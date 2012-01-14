<html>
<head>
    <link rel="stylesheet" href="Bootstrap/bootstrap.css" media="all">
</head>
<body>
<div class="container">
<div class="row">
    <div class="span16">
<?php
require_once 'FormBuild.php';
$Form=new Form();
echo $Form->init('post','test.php')
    ->text('Username',array(
        'name'=>'username',
        'placeholder'=>'Username'
    ))
    ->password('Password',array(
        'name'=>'password',
        'placeholder'=>'Password'
    ))
    ->select('User Type',array(
            'id'=>'user_type',
            'autocomplete'=>false
        ),array(
            0=>'-Choose a value-',
            1=>'Hello',
            2=>'Test'
        ),2)
    ->checkbox('Checkbox',array(
        'autocomplete'=>false
    ),true)
    ->radio('Radio',array(
        'data-id'=>3,
        'name'=>'GROUP'
    ))
    ->button('TEST!',array(
        'class'=>'btn success'
    ))
    ->submit()
    ->render();
?>
    </div>
</div>
</div>
</body>
</html>
