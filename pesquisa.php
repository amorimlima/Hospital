<?php
require_once '_loadPaths.inc.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Crianças como Parceiras | Hospital do Câncer de Barretos</title>

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/modulos/formulario.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/pesquisa.css" rel="stylesheet" /><!-- -->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="logo-container">
                        <img src="img/logo/logo_lg.png">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div id="Conteudo_Area">
                        <form id="formulario_pesquisa">
                            <fieldset>
                                <legend>Pesquisa de interesse</legend>
                                <div class="formfield">
                                    <label for="">Checkboxes</label>
                                    <span>
                                        <div>
                                            <input type="checkbox" checked id="Checkbox1">
                                            <label for="Checkbox1">Checkbox1</label>
                                            <input type="checkbox" id="Checkbox2">
                                            <label for="Checkbox2">Checkbox2</label>
                                        </div>
                                    </span>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript" src="js/lib/jquery.mask.js"></script>
    <script type="text/javascript" src="js/lib/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="js/modulos/formulario.js"></script>
    <script type="text/javascript" src="js/modulos/pesquisa.js"></script>

</html>