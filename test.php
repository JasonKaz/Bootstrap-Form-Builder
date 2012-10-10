<html>
<head>
    <link rel="stylesheet" href="bootstrap 2.1.1/css/bootstrap.css" media="all">
    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="bootstrap 2.1.1/js/bootstrap.min.js"></script>
    <style>
        .grouping input   {
            display: block;
            margin-bottom: 9px;
        }
    </style>
</head>
<body>
<div class="container">
<div class="row">
    <div class="span12">
<?php
require_once 'FormBuild.php';
$Form=new Form();
echo $Form->init('test.php', 'post', array(
        'class'=>'form-horizontal well'
    ))
    ->head('Test')
    ->group('Test',
        new Text(array(
            'name'=>'username',
            'id'=>'username',
            'placeholder'=>'username'
        )),
        new Password(array(
            'placeholder'=>'password',
            'class'=>'span2'
        )),
        new Help('test')
    )
    ->group('Hello',
        new Text(array(
            'append'=>'@'
        )),
        new Help('blah')
    )
    ->group('Goodbye',
        new Password(array(
            'prepend'=>'$'
        ))
    )
    ->group('Checkboxes!',
        new Checkbox('hi!'),
        new Checkbox('another!'),
        new Checkbox('last')
    )
    ->group('Radios',
        new Radio('1',array(
            'name'=>'r1',
            'checked'=>true
        )),
        new Radio('2', array(
            'name'=>'r1'
        ))
    )
    ->group('Inline Checkboxes',
        new Checkbox('1',array(), true),
        new Checkbox('2',array(), true),
        new Checkbox('3',array(), true)
    )
    ->group('Inline Radios',
        new Radio('1',array('name'=>'r2'), true),
        new Radio('2',array('name'=>'r2'), true),
        new Radio('3',array('name'=>'r2'), true)
    )
    ->group('Dropdown',
        new Dropdown(array(
            '1'=>1,
            '2'=>2
        ), '2', array(
            'autocomplete'=>false
        )),
        new Help('help')
    )
    ->group('File',
        new File()
    )
    ->actions(
        new Submit(),
        new Reset()
    )
    ->render();

$BD=new ButtonDropdown('User',array(
    array('id1','pencil','Edit'),
    array('id2','headphones','Listen')
));
echo $BD->render();

$BG=new ButtonGroup(
    new BGButton('signal', array(
        'id'=>'test'
    )),
    new BGButton('repeat')
);

echo $BG->render();


?>
    </div>
</div>
</div>
</body>
</html>
