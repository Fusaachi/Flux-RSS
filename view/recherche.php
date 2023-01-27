<?php
include_once("/wamp64/www/FluxRSS/assets/inc/front/head.php");
include("/wamp64/www/FluxRSS/assets/inc/front/header.php");
?>
<main>
    <div class="text-center">
        <h1>Recherche</h1>
    </div>
    <div class="container ">
            <div class="row">
        <?php


        if (!isset($_POST["url"])) {
        ?>
            <form class="text-center mt-5 mb-5" action="#" method="post">
                <label for="post">Entrer votre flux RSS : </label>
                <input type="text" name="url">
                <input type="submit" value="valider">
            </form>

            <?php
        } else {
        ?> <form class="text-center mt-5 mb-5" action="#" method="post">
                <label for="post">Entrer votre flux RSS : </label>
                <input type="text" name="url">
                <input type="submit" value="valider">
            </form>
            <?php
            echo appel($_POST["url"]);
        }
    ?>
        </div>
    </div>
<?php

        function appel($url)
        {

            $xml = file_get_contents($url);
            $xml = simplexml_load_string($xml);

            echo "<h1 class='mt-5 mb-3'>" . $xml->channel->title . "</h1>";
            foreach ($xml->channel->item as $key) {

                $content = $key->children('media', true)->content;
                $contentattr = $content->attributes();
                $image = $contentattr["url"];
            ?>
                <div class="col">
                    <div class="card m-none" style="width: 18rem; ">
                        <img src="<?= $image; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $key->title; ?></h5>
                            <p class="card-text"><?= $key->pubDate; ?></p>
                            <p class="card-text"><?= $key->description; ?></p>
                            <p class="card-text"><?= $key->guid ?></p>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
</main>











</div>
</main>
<?php
include("/wamp64/www/FluxRSS/assets/inc/front/footer.php")
?>