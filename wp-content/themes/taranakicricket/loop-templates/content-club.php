<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/1/2019
 * Time: 1:08 PM
 */
$club = new Club($post);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?=$club->getTitle()?></h1>
                </div>
            </div>
        </div>
    </div>
    <div id="content" class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 club-contacts-wrapper">
                <?=$club->getContent()?>
                <?=$club->getMedia()?>
            </div>
            <div class="col-12 col-sm-6">
                <?=$club->getClubImage()?>
            </div>
            <?=$club->displayMaps()?>
        </div>
    </div>
    <div class="navigation-wrapper player-nav">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                    $previous = $club->previous();
                    if($previous->id() <> "") {
                        echo '<a href="' . $previous->link() . '" class="previous"><i>' . $previous->getTitle() . '</i></a>';
                    }
                    echo '<a href="' . get_page_link(37) . '" class="listing"><span class="fa fa-th"></span></a>';
                    $next = $club->next();
                    if($next->id() <> "") {
                        echo '<a href="' . $next->link() . '" class="next"><i>' . $next->getTitle() . '</i></a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>
