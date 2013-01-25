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
use JasonKaz\FormBuild\Custom as Custom;
use JasonKaz\FormBuild\Textarea as Textarea;
use JasonKaz\FormBuild\Hidden as Hidden;
use JasonKaz\FormBuild\Email as Email;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap Form Builder Examples</title>
    <link rel="stylesheet" href="bootstrap-2.2.2/css/bootstrap.css" media="all">
    <link rel="stylesheet" href="prettify/prettify.css">
    <script src="prettify/prettify.js"></script>
    <style>
        .grouping input   {
            display: block;
            margin-bottom: 9px;
        }
        
        .bs-docs-example:after {
		    background-color: #F5F5F5;
		    border: 1px solid #DDDDDD;
		    border-radius: 4px 0 4px 0;
		    color: #9DA0A4;
		    content: "Example";
		    font-size: 12px;
		    font-weight: bold;
		    left: -1px;
		    padding: 3px 7px;
		    position: absolute;
		    top: -1px;
		}
		
		.bs-docs-example {
		    background-color: #FFFFFF;
		    border: 1px solid #DDDDDD;
		    border-radius: 4px 4px 4px 4px;
		    margin: 15px 0;
		    padding: 39px 19px 14px;
		    position: relative;
		}
		
		.bs-docs-example + .prettyprint {
		    margin-top: -20px;
		    padding-top: 15px;
		}
    </style>
</head>
<body onload="prettyPrint()">
<div class="container">
    <div class="row">
        <div class="span12">
        	<div class="bs-docs-example">
            <?php
            $Form=new Form;
            echo $Form->init('#','post')
                ->head('Default Style')
                ->group('Label Name',
                    new Text(array('placeholder'=>'Type something...')),
                    new Help('Example block-level help text here.'),
                    new Checkbox('Check me out', array('checked'=>true)),
                    new Submit()
                )
                ->render();
			?>
			</div>
			<pre class="prettyprint linenums">
$Form=new Form;
echo $Form->init('#','post')
	->head('Default Style')
	->group('Label Name',
	    new Text(array('placeholder'=>'Type something...')),
	    new Help('Example block-level help text here.'),
	    new Checkbox('Check me out', array('checked'=>true)),
	    new Submit()
	)
	->render();</pre>
			<div class="bs-docs-example">
			<?php
            $Form=new Form;
            echo $Form->init('#','post',array(
	                'class'=>'form-search'
	            ))
	            ->head('Search Forms')
	            ->group('',
	                new Text(array('class'=>'input-medium search-query')),
	                new Submit('Search')
	            )
				->group('',
					new Text(array(
						'class'		=> 'input-medium search-query',
						'append'	=> new Button('Search')
					))
				)
	            ->render();
			?>
			</div>
			<pre class="prettyprint linenums">
$Form=new Form;
echo $Form->init('#','post',array(
	    'class'=>'form-search'
	))
	->head('Search Forms')
	->group('',
	    new Text(array('class'=>'input-medium search-query')),
	    new Submit('Search')
	)
	->group('',
		new Text(array(
			'class'		=> 'input-medium search-query',
			'append'	=> new Button('Search')
		))
	)
	->render();</pre>
			<div class="bs-docs-example">
			<?php
            $Form=new Form;
            echo $Form->init('#','post',array(
	                'class'=>'form-inline'
	            ))
	            ->head('Inline Form')
	            ->group('',
	                new Text(array(
	                	'placeholder'=>'Email',
	                	'class'=>'input-small'
					)),
	                new Password(array(
	                	'placeholder'=>'Password',
	                	'class'=>'input-small'
					)),
	                new Checkbox('Remember me'),
	                new Submit('Sign In')
	       		)
	            ->render();
			?>
			</div>
			<pre class="prettyprint linenums">
$Form=new Form;
echo $Form->init('#','post',array(
        'class'=>'form-inline'
    ))
    ->head('Inline Form')
    ->group('',
        new Text(array(
        	'placeholder'=>'Email',
        	'class'=>'input-small'
		)),
        new Password(array(
        	'placeholder'=>'Password',
        	'class'=>'input-small'
		)),
        new Checkbox('Remember me'),
        new Submit('Sign In')
    )
    ->render();</pre>
			<div class="bs-docs-example">
			<?php
            $Form=new Form;
            echo $Form->init('#', 'post', array(
	                'class'=>'form-horizontal'
	            ))
	            ->head('Horizontal Form')
	            ->group('Email', 'warning',
	                new Email(array(
	                    'placeholder'   => 'Email',
	                    'id'            => 'inputEmail'
	                ))
	            )
	            ->group('Password',
	                new Password(array(
	                    'placeholder'   => 'Password',
	                    'id'            => 'inputPassword'
	                )),
	                new Help('This is a login form!')
	            )
	            ->group('',
	                new Checkbox('Remember me', array(
	                    'checked'   => true
	                )),
	                new Submit('Sign in', array(
	                    'class' => 'btn'
	                ))
	            )
				->render();
			?>
			</div>
			<pre class="prettyprint linenums">
$Form=new Form;
echo $Form->init('#', 'post', array(
        'class'=>'form-horizontal'
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
        new Help('This is a login form!')
    )
    ->group('',
        new Checkbox('Remember me', array(
            'checked'   => true
        )),
        new Submit('Sign in', array(
            'class' => 'btn'
        ))
    )
    ->render();</pre>
    		<div class="bs-docs-example">
    		<?php
			$Form=new Form;
			echo $Form->init('#', 'post', array(
					'class'	=> 'form-horizontal'
				))
				->head('Supported Form Controls')
				->hidden(array(
					'name'	=> 'single-hidden',
					'value'	=> 'single-hidden-value',
					'id'	=> 'single-hidden-id'
				))
				->hidden(array(array(
					'name'	=> 'multiple-hidden-1',
					'value'	=> 'multiple-hidden-1-value'
					), array(
					'name'	=> 'multiple-hidden-2',
					'value'	=> 'multiple-hidden-2-value'
				)))
				->group('Text', new Text(array(
					'required'	=> true
				)))
	            ->group('Password', new Password())
				->group('Hidden', new Custom('Hiddens are handled by the Form->hidden() function'))
				->group('Textarea', new Textarea('Default text'))
	            ->group('Checkboxes',
	                new Checkbox('Checkbox 1'),
	                new Checkbox('Checkbox 2')
	            )
	            ->group('Radios',
	                new Radio('Radio 1'),
	                new Radio('Radio 2')
	            )
	            ->group('Inline Checkboxes',
	                new Checkbox('Checkbox 1', array(
						'checked'	=> true
					), true),
	                new Checkbox('Checkbox 2', array(), true)
	            )
	            ->group('Select',
	                new Select(array(
	                    1,2,3
	                ),1)
	            )
	            ->group('Multiple Select',
	                new Select(array(
	                    1,2,3
	                ),array(0,2),array(
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
				->group('Custom HTML',
					new Custom('<img src="http://placehold.it/200x200" class="img-rounded" />')
				)
	            ->actions(
	                new Submit('Submit', array(
						'class'	=> 'btn-primary'
					)),
	                new Reset()
	            )
	            ->render();
            ?>
           </div>
           <pre class="prettyprint linenums">
$Form=new Form;
echo $Form->init('#', 'post', array(
		'class'	=> 'form-horizontal'
	))
	->head('Supported Form Controls')
	->hidden(array(
		'name'	=> 'single-hidden',
		'value'	=> 'single-hidden-value',
		'id'	=> 'single-hidden-id'
	))
	->hidden(array(array(
		'name'	=> 'multiple-hidden-1',
		'value'	=> 'multiple-hidden-1-value'
		), array(
		'name'	=> 'multiple-hidden-2',
		'value'	=> 'multiple-hidden-2-value'
	)))
	->group('Text', new Text())
    ->group('Password', new Password())
    ->group('Hidden', new Custom('Hiddens are handled by the Form->hidden() function'))
    ->group('Textarea', new Textarea('Default text'))
    ->group('Checkboxes',
        new Checkbox('Checkbox 1'),
        new Checkbox('Checkbox 2')
    )
    ->group('Radios',
        new Radio('Radio 1'),
        new Radio('Radio 2')
    )
    ->group('Inline Checkboxes',
        new Checkbox('Checkbox 1', array(
        	'checked'	=> true
        ), true),
        new Checkbox('Checkbox 2', array(), true)
    )
    ->group('Select',
        new Select(array(
            1,2,3
        ), 1)
    )
    ->group('Multiple Select',
        new Select(array(
            1,2,3
        ), array(0,2), array(
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
            'prepend'	=> new Button('Go!', array('type'=>'button','class'=>'btn')),
            'append'	=> new Button('Go2!', array('type'=>'button','class'=>'btn'))
        ))
    )
    ->group('Custom HTML',
    	new Custom('Any HTML here')
    )
    ->actions(
        new Submit('Submit', array(
        	'class'	=> 'btn-primary'
        )),
        new Reset()
    )
    ->render();</pre>
        </div>
    </div>
</div>
</body>
</html>
