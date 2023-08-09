<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/30/2019
 * Time: 11:49 AM
 */
$profile = new Player($post);
$str = $_SERVER['REQUEST_URI'];
// check if we are view mens or women player
if(strpos($str, 'taranaki-men') !== false)
{
    $listid = 24;
    $post_type = 'taranaki-men';
} else {
    $listid = 25;
    $post_type = 'taranaki-women';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?=$profile->getTitle()?></h1>
                    <div class="playing-role"><?=$profile->getRole()?></div>
                </div>
            </div>
        </div>
    </div>
    <div id="content" class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-8">
                <div class="profile-wrapper">
                    <ul>
                        <li><label>DOB:</label><?=$profile->getDOB()?></li>
                        <li><label>Birthplace:</label><?=$profile->getBirthplace()?></li>
                        <li><label>Nickname:</label><?=$profile->getNickname()?></li>
                        <li><label>Club:</label><?=$profile->getClub()?></li>
                        <li><label>Most memorable moment:</label><?=$profile->getMemorableMoment()?></li>
                    </ul>
                </div>
                <?php
                if($profile->getCrichqID() <> "") {
                    $crichq_link = 'https://www.crichq.com/players/' . $profile->getCrichqID() . '/statistics/domestic';
                ?>
                <div class="stats-wrapper">
                    <h2>Statistics</h2>
                    <a href="<?=$crichq_link?>" target="_blank">View stats</a>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="image-wrapper">
                    <?php
                    if($profile->getActionShot() <> "")
                    {
                        $imageid = getImageID($profile->getActionShot());
                        $img = wp_get_attachment_image_src($imageid, 'action');
                    ?>
                        <img src="<?=$img[0]?>" alt="<?=$profile->getTitle()?> in action" />
                    <?php
                    } else {
                        $imageid = getImageID($profile->getProfileImage());
                        $img = wp_get_attachment_image_src($imageid, 'profile');
                    ?>
                        <img src="<?=$img[0]?>" alt="<?=$profile->getTitle()?>" />
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="navigation-wrapper player-nav">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                    $previous = $profile->previous($post_type);
                    if($previous->id() <> "") {
                        echo '<a href="' . $previous->link() . '" class="previous">' . $previous->getTitle() . '</a>';
                    }
                    echo '<a href="' . get_page_link($listid) . '" class="listing"><span class="fa fa-th"></span></a>';
                    $next = $profile->next($post_type);
                    if($next->id() <> "") {
                        echo '<a href="' . $next->link() . '" class="next">' . $next->getTitle() . '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>
