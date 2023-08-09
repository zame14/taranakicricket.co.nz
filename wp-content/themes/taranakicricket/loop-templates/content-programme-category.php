<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/23/2023
 * Time: 11:51 AM
 */
$cate = get_queried_object();
$category_id = $cate->term_id;
$arr = getProductByCategory($category_id);
//print_r($cate);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row justify-content-center row-eq-height">
        <?php
        foreach($arr as $object) {
            $slug = $object->link();
            $title = $object->getTitle();
            $img = $object->getFeatureImage();
            echo '<div class="col-12 col-sm-6 col-md-4 col-lg-4 program-panel">
                <a href="' . $slug . '" class="inner-wrapper">
                    <div class="image-wrapper">
                        ' . $img . '
                    </div>
                    <div class="content-wrapper">
                        <h3>' . $title . '</h3>
                    </div>
                    <div class="btn-wrapper">
                        <span class="view-more">view</span>
                    </div>
                </a>
            </div>';
        }
        ?>
    </div>
</article>