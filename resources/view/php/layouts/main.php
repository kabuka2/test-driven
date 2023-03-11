<?php

/**@var $styles **/
/**@var $page **/
/**@var $script **/
/**@var $title **/
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?= $this->style ?? '';?>
        <?= $this->scripts ?? ''?>
        <title>
            <?= $this->title ?? '' ?>
        </title>
    </head>
      <body>
        <div class="wrapper">
            <header></header>
            <main>
                <div class="container">
                    <?= $page ?>
                </div>
            </main>
            <footer></footer>
        </div>
    </body>

</html>

