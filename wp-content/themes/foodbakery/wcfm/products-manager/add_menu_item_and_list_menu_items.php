<div class="col-md-4 field-holder mb-3 float-right mr-0 ml-auto mt-5">
    <button class="btn btn-success float-right mb-4" type="button" id="open-menu-item-form"><i class="fa fa-plus"></i> Add Menu Item </button>
</div>

<form id="add-menu-item-form" class="form" style="display: none;">
    <div class="field-holder mb-3">
        <a class=" float-right red" id="close-menu-item-form" type="button" title="Close"><i class="fa fa-times"></i></a>
    </div>

    <div class="row ml-0 mr-0">
        <div class="col-md-12">
            <div class="field-holder">
                <div class="mt-2 mb-1"><label for="restaurant-menu">Restaurant Menu</label></div>
                <select type="text" name="restaurant_menu" class="form-field required" id="restaurant_menu"></select>
            </div>
        </div>
    </div>
    <div class="row ml-0 mr-0">
        <div class="col-md-4">
            <div class="field-holder">
                <div class="mt-2 mb-1"><label for="post_title">Title</label></div>
                <input type="text" name="post_title" class="form-field required" id="post_title" placeholder="Menu item title" value=""/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="field-holder">
                <div class="mt-2 mb-1"><label for="_price">Price</label></div>
                <input type="text" name="_price" class="form-field required" id="menu_item_price" placeholder="Menu item price" value=""/>
            </div>
        </div>
        <div class="col-md-2">
            <div class="field-holder">
                <div class="mt-2 mb-1"><label for="food_image">Food Image</label></div>
                <input type="file" name="food_image" class="form-field required" id="food_image" size="24" onchange="document.getElementById('preview_img').src = window.URL.createObjectURL(this.files[0])"/>
            </div>
        </div>
        <div class="col-md-2">
            <div class="field-holder">
                <div class="mt-2 mb-1">&nbsp;</div>
                <img src="#" class="img-fluid img-thumbnail" id="preview_img"/> 
            </div>
        </div>
    </div>

    <div class="row ml-0 mr-0">
        <div class="col-md-12">
            <div class="field-holder">
                <div class="mt-2 mb-1"><label for="">Nutritional Information</label></div>
                <div class="nutritional_info_container">
                    <?php $nutritional_info_icons = array('Bnana', 'Egg', 'Chilli', 'Onion', 'Garlic', 'Lettuce', 'Tomato', 'Lactose', 'NoSugar', 'LowFat', 'Milk', 'Fish', 'Beef', 'Mutton', 'Chicken', 'Gluten'); ?>
                    <?php foreach ($nutritional_info_icons as $nutrition_item): ?>
                        <div><?= $nutrition_item; ?>
                            <input type="checkbox" name="nutritional_information[]" id="<?= $nutrition_item; ?>" value="<?= $nutrition_item; ?>" class="nutritional_info_check" title="Contains <?= $nutrition_item; ?>"/>
                            <!--<img src="<?= $nutrition_item_icon_url; ?>" class="nutritional_info_icon"/>-->
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>                                          
    </div>

    <div class="row ml-0 mr-0">
        <div class="col-md-12">
            <div class="field-holder">
                <div class="mt-2 mb-1"><label for="product-description">Description</label></div>
                <textarea class="form-field required" name="excerpt" id="excerpt" placeholder="Menu category description"></textarea>
            </div>
        </div>
    </div>
    <div id="extras_new" class="extras row">
        <div id="extras_response" class="alert alert-success" style="display: none;"></div>
    </div>
    <div class="row ml-0 mr-0">
        <div class="col-md-6">
            <div class="field-holder">
                <button onclick="ez_add_menu_extras(this)" id="add_menu_item_extra" class="btn btn-info float-left add_menu_item_extra" type="button"><i class="fa fa-plus-square"></i> Add Menu Item Extra</button>
            </div>     
        </div>   
        <div class="col-md-6">
            <div class="field-holder">
                <button id="add_menu_item" class="btn btn-success float-right" type="button"><i class="fa fa-plus-circle"></i> Save Menu Item</button>
            </div>     
        </div>     
    </div>

</form>
<div class="clearfix">&nbsp;</div>
<div id="ez_categories_with_food-menu"></div>
<div class="clearfix">&nbsp;</div>
