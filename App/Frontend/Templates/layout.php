<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= isset($title)? $title : "Birdy"?></title>
    </head>

    <body>
        <div class="wrap">
            <header>
                <h1>Birdy</h1>
            </header>
        </div>

        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <?php if ($user->isAuthentificated()) { ?>
                <li><a href="/admin/">Admin</a></li>
                <li><a href="/admin/news-insert.html">Ajouter une news</a></li>
                <?php } ?>
            </ul>
        </nav>

        <div id="content-wrap">
            <section id="main">
                <?php
                    if($user->hasFlash())
                        echo "<p>" . $user->getFlash() . "</p>";
                ?>

                <?= $content ?>
            </section>
        </div>
        
        <footer></footer>
    </body>
</html>