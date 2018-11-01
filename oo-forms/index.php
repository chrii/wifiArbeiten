<?php
    require_once 'init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formular Objecktorientiert</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>

<div class="container">
    <header class="site-header">
        <h1>Formular Objektorientiert</h1>
    </header> 
    <main>
        <h2>Test Formular</h2>
        <form action="" method="post" class="pure-form pure-form-stacked">
        <?php
            foreach ($formConf as $name => $conf) {
                $type = $conf['type'];
                $field;
                switch ($type) {
                    case 'textarea':
                        $field = new Textarea($conf);
                        break;
                    case 'select':
                        $field = new Select($conf);
                    break;
                    default:
                        $field = new Input($conf);

                }
                echo $field->render();
            }
           /*  $vn = new Input($formConf['vorname']);
            echo $vn->render();
            

            $nachricht = new Textarea($formConf['nachricht']);
            echo $nachricht->render();

            $bl = new Select($formConf['bundeslaender']);
            echo $bl->render(); */
           
           
           
            /* 
           // Input1_single-params.php
           $vn = new Input('vorname', 'vorName', 'text', 'Vorname');
            echo $vn->render();

            $nn = new Input('nachname', 'nachName', 'text', 'Nachname');
            echo $nn->render();

            $tel = new Input('tel', 'tel', 'tel', 'Telefon');
            echo $tel->renderLabel();
            echo '<p>blablablabla</p>';
            echo $tel->renderField();
            */
        ?>
        </form>
    </main>
</div>

</body>
</html>