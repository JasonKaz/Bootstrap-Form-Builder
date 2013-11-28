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
                $Form=new \JasonKaz\FormBuild\Form();
                $Form->init("#","POST",\JasonKaz\FormBuild\FormType::Horizontal);
                $Form->setWidths(2, 10);

                $Form->group($Form->label('User'), new \JasonKaz\FormBuild\Text(array('id'=>'test', 'class'=>'sd')));
                $Form->group($Form->label('Pass'), new \JasonKaz\FormBuild\Text(array('id'=>'hello')));
                $Form->group(
                    $Form->checkbox("Checkbox text", false),
                    $Form->checkbox("More Text", false)
                );

                echo $Form->render();
                ?>
            </div>
        </div>
    </div>
  </body>
</html>


