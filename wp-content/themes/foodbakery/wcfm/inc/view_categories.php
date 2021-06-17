<?php
add_action("wp_ajax_EZ_get_categories_of_menu", "EZ_get_categories_of_menu");

function EZ_get_categories_of_menu() {
    ob_start();
    $product_categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0');
    $category_options_list = "<option value=''> SELECT </option>";
    ?>
    <?php
    foreach ($product_categories as $category) {
        $category_options_list .= "<option value='$category->name'>$category->name</option>";
        ?>
        <li class="pt-1 pb-1 clearfix">
            <form id="form_<?= $category->term_id; ?>">


                <div class="shown headingdiv" id="info-<?= $category->term_id; ?>">
                    <div class="float-left"> <i class="fa fa-bars"></i> &nbsp;<?= $category->name; ?></div>  
                    &nbsp;
                    <?php if (current_user_can('administrator')): ?>
                        <div class="float-right">
                            <a href="javascript:void(0)" class="edit"><i class="fa fa-pencil"></i></a>&nbsp;
                            <a href="javascript:void(0)" onclick="ez_delete_category(this)" class="delete_category" data-id="<?= $category->term_id; ?>" data-name="<?= $category->name; ?>">
                                <i class="fa fa-trash-alt red"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (current_user_can('administrator')): ?>
                    <div class="form contentdiv" id="detail-<?= $category->term_id; ?>" style="display:none">
                        <input name="term_id" type="hidden" value="<?= $category->term_id; ?>" />
                        <div class="field-holder">
                            <a class="float-right red contentcross" type="button"><i class="fa fa-times"></i></a>
                        </div>
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="name">Category</label></div>
                            <input type="text" name="name" class="form-field" placeholder="<?= isset($category->name) ? $category->name : 'Menu Category title'; ?>" value="<?= isset($category->name) ? $category->name : ''; ?>"/>
                        </div>
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="description">Description</label></div>
                            <textarea class="form-field" name="description" placeholder="<?= isset($category->description) ? $category->description : 'Menu category description'; ?>"><?= isset($category->description) ? $category->description : ''; ?></textarea>
                        </div>
                        <div class="field-holder">
                            <button type="button" onclick="ez_update_category(this)" class="btn btn-success float-right ez_update_category" data-id="<?= $category->term_id; ?>"><i class="fa fa-check"></i> Update Category </button>
                        </div>
                    </div>
                <?php endif; ?>

            </form>
        </li>
    <?php } ?>
    <script>
        jQuery(function () {
            jQuery('.headingdiv').off('click').on('click', function () {
                jQuery(this).closest('form').find('.contentdiv').toggle('slow');
            });
            jQuery('.contentcross').off('click').on('click', function () {
                jQuery(this).closest('form').find('.contentdiv').hide('slow');
            });
        });
    </script>
    <?php
    $html = ob_get_clean();
    echo json_encode(array('Status' => true, 'MSG' => 'ok', 'SHtml' => $html, 'category_options_list' => $category_options_list));
    exit;
}
