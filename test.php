<?php
include 'env.inc.php';

use JasonKaz\FormBuild\Form as Form;
use JasonKaz\FormBuild\Text as Text;
use JasonKaz\FormBuild\Help as Help;
use JasonKaz\FormBuild\Checkbox as Checkbox;
use JasonKaz\FormBuild\Submit as Submit;
use JasonKaz\FormBuild\Password as Password;
use JasonKaz\FormBuild\Select as Select;
use JasonKaz\FormBuild\Radio as Radio;			
use JasonKaz\FormBuild\Button as Button;		
use JasonKaz\FormBuild\Reset as Reset;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap Form Builder Examples</title>
    <link rel="stylesheet" href="bootstrap-2.1.1/css/bootstrap.css" media="all">
    <script src="jquery-1.7.1.min.js"></script>
    <script src="bootstrap-2.1.1/js/bootstrap.min.js"></script>
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
            $Form=new Form();
            echo $Form->init('#','post',array(
                'class'=>'well'
            ))
                ->head('Default Style')
                ->group('Label Name',
                    new Text(array('placeholder'=>'Type something...')),
                    new Help('Example block-level help text here.'),
                    new Checkbox('Check me out',array('checked'=>true)),
                    new Submit()
                )
                ->render();

            $Form=new Form();
            echo $Form->init('#','post',array(
                'class'=>'form-search well'
            ))
                ->head('Search Form')
                ->group('',
                    new Text(array('class'=>'input-medium search-query')),
                    new Submit('Search')
                )
                ->render();

            $Form=new Form();
            echo $Form->init('#','post',array(
                'class'=>'form-inline well'
            ))
                ->head('Inline Form')
                ->group('',
                    new Text(array('placeholder'=>'Email','class'=>'input-small')),
                    new Password(array('placeholder'=>'Password','class'=>'input-small')),
                    new Checkbox('Remember me'),
                    new Submit('Sign In')
            )
                ->render();

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
                )),
                new Help('test')
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
                new Select(array(
                    1,2,3
                ),1)
            )
            ->group('Multiple Select',
                new Select(array(
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
                    'append'   => new Button('Go!', array('type'=>'submit', 'class'=>'1'))
                ))
            )
            ->group('Button append & prepend',
                new Text(array(
                    'prepend'   => new Button('Go!', array('type'=>'button','class'=>'btn')),
                    'append'   => new Button('Go2!', array('type'=>'button','class'=>'btn'))
                ))
            )
            ->actions(
                new Submit(),
                new Reset()
            )
            ->render();
            ?>
        </div>
    </div>
</div>
</body>
</html>
