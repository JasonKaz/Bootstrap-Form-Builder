<?php
include '../env.inc.php';
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
            $Form->init("#", "POST", \JasonKaz\FormBuild\FormType::Normal);
            $Form->setWidths(2, 10);

            $Form->group($Form->label('User'), new \JasonKaz\FormBuild\Text(['id' => 'test', 'class' => 'sd']));
            $Form->group($Form->label('Pass'), new \JasonKaz\FormBuild\Text(['id' => 'hello']));
            $Form->group(
                $Form->checkbox("Checkbox text", true),
                $Form->checkbox("More Text", true)
            );
            $Form->group($Form->label('Textarea'), new \JasonKaz\FormBuild\Textarea('', ['disabled' => true]));
            $Form->group($Form->label('Select'), new \JasonKaz\FormBuild\Select(['one' => 1, 'two' => 2, 'three' => 3], 'two', ['multiple' => true]));
            $Form->group($Form->label('Static Text'), new \JasonKaz\FormBuild\StaticText('weee'));

            echo $Form->render();
            ?>
        </div>
    </div>
</div>
</body>
</html>


