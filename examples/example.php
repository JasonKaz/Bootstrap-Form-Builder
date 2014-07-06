<?php
include '../env.inc.php';

use \JasonKaz\FormBuild\Text as Text;
use \JasonKaz\FormBuild\Password as Password;
use \JasonKaz\FormBuild\Textarea as Textarea;
use \JasonKaz\FormBuild\Select as Select;
use \JasonKaz\FormBuild\StaticText as StaticText;
use \JasonKaz\FormBuild\File as File;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Bootstrap-3.0.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php
            $Form = new \JasonKaz\FormBuild\Form();
            $Form->init("#", "POST", \JasonKaz\FormBuild\FormType::Horizontal);
            $Form->setWidths(2, 10); //Horizontal forms only
            $Form->hidden([
                ['name' => 'hidden1'],
                ['name' => 'hidden2']
            ]);

            $Form->group($Form->label('User'), new Text(['id' => 'test', 'class' => 'sd']));
            $Form->group($Form->label('Pass'), new Password(['id' => 'hello']));
            $Form->group(
                $Form->checkbox("Checkbox text", true),
                $Form->checkbox("More Text", true)
            );
            $Form->group(
                $Form->radio("Radio 1", true),
                $Form->radio("Radio 2", true)
            );
            $Form->group($Form->label('Textarea'), new Textarea('', ['disabled' => true]));
            $Form->group($Form->label('Select'), new Select(['one' => 1, 'two' => 2, 'three' => 3], 'two', ['multiple' => true]));
            //$Form->group($Form->label('Static Text'), new StaticText('weee'));
            $Form->group($Form->label('File'), new File(), "Help Text");

            echo $Form->render();
            ?>
        </div>
    </div>
</div>
</body>
</html>


