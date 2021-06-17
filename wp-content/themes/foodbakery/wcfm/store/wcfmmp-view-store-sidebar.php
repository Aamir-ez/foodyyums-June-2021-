<?php
/**
 * The Template for displaying store sidebar.
 *
 * @package WCfM Markeplace Views Store Sidebar
 *
 * For edit coping this to yourtheme/wcfm/store 
 *
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $WCFM, $WCFMmp;

if (!$WCFMmp->wcfmmp_vendor->is_store_sidebar())
    return;

$widget_args = apply_filters('wcfmmp_store_sidebar_args', array(
    'before_widget' => '<aside class="widget">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="sidebar_heading"><h4 class="widget-title">',
    'after_title' => '</h4></div>',
        ));
?>
<?php $product_categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0'); ?>
<div class="col-md-3">
    <div class="categories-menu">
        <h6><i class="icon-restaurant_menu"></i>Categories</h6>
        <ul class="menu-list">
            <?php foreach ($product_categories as $category): ?>
                <li class="active">
                    <a href="#<?php echo str_replace(" ", "_", $category->name); ?>" class="menu-category-link"> 
                        <?php echo $category->name; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php do_action( 'wcfmmp_store_before_sidabar', $store_user->get_id() ); ?>

      <?php dynamic_sidebar( 'sidebar-wcfmmp-store' ); ?>



      <?php do_action( 'wcfmmp_store_after_sidebar', $store_user->get_id() );  ?>

</div><!-- .left_sidebar -->