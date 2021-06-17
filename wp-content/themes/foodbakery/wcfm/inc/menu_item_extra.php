<?php 
add_action("wp_ajax_EZ_get_menu_item_extra", "EZ_get_menu_item_extra");

function EZ_get_menu_item_extra() {
//    print_r($_REQUEST);    exit();
ob_start();
$n = $_REQUEST['index_num'];
?>
<div class="extra_item col-md-11 ml-auto mr-auto">
    <div class="ribbon"><span>Extra</span></div>
    <div class="field-holder mb-3 remove_extra">
        <a onclick="ez_remove_extra_item(this)" class="float-right red" id="close-menu-item-form" type="button" title="Remove"><i class="fa fa-times-circle"></i></a>
    </div>
    <div class="row ml-0 mr-0">
        <div class="col-md-4">
            <div class="field-holder item_extras">
                <div class="mt-2 mb-1"><label for="heading_menu_item_extra_">Heading</label></div>
                <input type="text" name="menu_item_extra[<?= $n ?>][heading][]" class="form-field" placeholder="Heading" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="field-holder item_extras">
                <div class="mt-2 mb-1"><label for="type_menu_item_extra_">Extra Type</label></div>
                <select type="text" name="menu_item_extra[<?= $n ?>][type][]" class="form-field">
                    <option value="single">Single</option>
                    <option value="multiple">Multiple</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="field-holder item_extras">
                <div class="mt-2 mb-1"><label for="heading_menu_item_required_extra_">Required</label></div>
                <input type="text" name="menu_item_extra[<?= $n ?>][req][]" class="form-field" placeholder="Required?" />
            </div>
        </div>
    </div>

    <div class="row ml-0 mr-0 extra_sub">
        <?php //$sub = rand(0, 50000);       ?>
        <div class="col-md-4">
            <div class="field-holder item_extras">
                <div class="mt-2 mb-1"><label for="title_menu_item_extra_">Title</label></div>
                <input type="text" name="menu_item_extra[<?= $n ?>][sub_title][]" class="form-field extra_sub_title" placeholder="Title" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="field-holder item_extras">
                <div class="mt-2 mb-1"><label for="price_menu_item_extra_">Price</label></div>
                <input type="text" name="menu_item_extra[<?= $n ?>][sub_price][]" class="form-field extra_sub_price" placeholder="Price" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="field-holder item_extras">
                <div class="mt-2 mb-1"><label>&nbsp;</label></div>
                <button type="button" class="btn btn-outline btn-outline-success" id="" onclick="ez_add_extra_item_sub(this)" title="Add more"><i class="fa fa-plus"></i></button> 
                <button type="button" class="btn btn-outline btn-outline-danger" id="" onclick="ez_remove_extra_item_sub(this)" title="Remove this"><i class="fa fa-minus"></i></button>                                                    
            </div>
        </div>
    </div>
</div> 
<?php
$html = ob_get_clean();
echo json_encode(array('Status' => true, 'MSG' => 'Menu item extra added successfully', 'SHtml' => $html, 'category_options_list' => $category_options_list));
exit;
}