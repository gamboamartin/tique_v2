<?php
use config\generales;
include "./init.php";
require './vendor/autoload.php';
$generales = new generales();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Inmobiliaria Tique</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <?php include $generales->path_base.'templates/css.php'?>
    </head>
    <body class="">
        <div id="fb-root"></div>
        <div class="container container-wrapper">
            <header class="header">
                <?php include $generales->path_base.'templates/head/_head.php'?>
            </header><!-- /.header-->
            <main class="main section-color-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="h-side top-pad h-side-slim clearfix">

                            </div> <!-- /. content-header -->

                            <?php include $generales->path_base.'templates/lista_casas/elige-tu-hogar/_lista_casas_elije_tu_hogar.php' ?>

                        </div><!-- /.center-content -->
                        <div class="col-md-3 sidebar-right">
                            <div class="widget text-center">
                                <div class="fb-page" data-href="https://www.facebook.com/TIQUE-Inmobiliaria-y-Construcción-105298222143206/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/TIQUE-Inmobiliaria-y-Construcción-105298222143206/"><a href="https://www.facebook.com/TIQUE-Inmobiliaria-y-Construcción-105298222143206/">Facebook</a></blockquote></div></div>
                            </div><!-- /.widget-facebook -->
                        </div>
                        <!-- /.right side bar -->
                    </div>
                </div>
            </main><!-- /.main-part-->
            <?php include $generales->path_base.'templates/agentes/index/_agentes_index.php' ?>
            <?php include $generales->path_base.'templates/noticias/index/_noticias_index.php'?>
            <?php include $generales->path_base.'templates/ubicaciones/_ubicaciones_hogares.php'?>

            <footer class="footer">
                <?php include $generales->path_base.'templates/footer/_footer.php' ?>
            </footer>
            <a class="btn btn-scoll-up color-secondary" id="btn-scroll-up"></a>
        </div>
        <?php include $generales->path_base.'templates/java.php' ?>
    </body>

</html>
