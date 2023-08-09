<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/29/2019
 * Time: 12:43 PM
 */
global $post;
$comp = new Competition($post->ID);
($comp->getGrade() == "Senior") ? $p = 36 : $p = 45;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?=$comp->getTitle()?></h1>
                </div>
            </div>
        </div>
    </div>
    <?php
    if($post->ID <> 1298) { ?>
        <div id="content" class="container">
            <div class="row">
                <div class="col-12 iframe-wrapper">
                    <iframe style="border: none;"
                            src="https://www.crichq.com/plugins/base?width=1140&amp;height=600&amp;border=1#competitions/<?=$comp->getCrichqID() ?>"
                            width="1140" height="600"></iframe>
                </div>
            </div>
        </div>
        <?php
    } else { ?>
        <div id="content" class="container">
            <div class="row">
                <div class="col-12 current-results"><a href="https://www.crichq.com/clubs/38277/matches/results" target="_blank">View current age group tournament results</a></div>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="navigation-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="fa fa-long-arrow-left"></span> <a href="<?=get_page_link($p)?>">Back to fixtures</a>
                </div>
            </div>
        </div>
    </div>
</article>
