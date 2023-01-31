<?php
include("/wamp64/www/FluxRSS/assets/inc/front/head.php");
include("/wamp64/www/FluxRSS/assets/inc/front/header.php");
?>

    <main>
        <div class="container ">
            <div class="row">

                <?php
                appel('https://www.lemonde.fr/jeux-video/rss_full.xml');
                appel("https://www.lemonde.fr/cultures-web/rss_full.xml");
                appel("https://www.lemonde.fr/photo/rss_full.xml");
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
<?php
    include("/wamp64/www/FluxRSS/assets/inc/front/footer.php")
?>