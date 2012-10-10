<!DOCTYPE html>
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
            echo $Form->init('#', 'post', array(
                'class'=>'form-horizontal well'
            ))
                ->head('Horizontal Form')
                ->group('Email',
                new Text(array(
                    'placeholder'   => 'Email',
                    'id'            => 'inputEmail'
                ))
            )
                ->group('Password',
                new Password(array(
                    'placeholder'   => 'Password',
                    'id'            => 'inputPassword'
                ))
            )
                ->group('',
                new Checkbox('Remember me', array(
                    'checked'   => true
                )),
                new Submit('Sign in', array(
                    'class' => 'btn'
                ))
            )
                ->group('Checkboxes',
                new Checkbox('test'),
                new Checkbox('test2')
            )
                ->group('Radios',
                new Radio('test',array('name'=>'test')),
                new Radio('test2',array('name'=>'test'))
            )
                ->group('Inline Checkboxes',
                new Checkbox('test',array(),false),
                new Checkbox('test2',array(),false)
            )
                ->group('Select',
                new Dropdown(array(
                    1,2,3
                ),1)
            )
                ->group('Multiple Select',
                new Dropdown(array(
                    1,2,3
                ),array(1,2),array(
                    'multiple'  => true
                ))
            )
                ->group('Prepended Input',
                new Text(array(
                    'prepend'   => '@'
                ))
            )
                ->group('Appended Input',
                new Text(array(
                    'append'   => '$'
                ))
            )
                ->group('Combined prepend & append',
                new Text(array(
                    'prepend'   => '@',
                    'append'    => '$'
                ))
            )
                ->group('Button Prepend',
                new Text(array(
                    'prepend'   => new Button('Go!', array('type'=>'button','class'=>'btn'))
                ))
            )
                ->group('Button Append',
                new Text(array(
                    'append'   => new Button('Go!', array('type'=>'button','class'=>'btn'))
                ))
            )
                ->group('Button append & prepend',
                new Text(array(
                    'prepend'   => new Button('Go!', array('type'=>'button','class'=>'btn')),
                    'append'   => new Button('Go2!', array('type'=>'button','class'=>'btn'))
                ))
            )
                ->render();
            ?>
        </div>
    </div>
</div>
</body>
</html>
