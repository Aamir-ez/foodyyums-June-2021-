<div class="add-new">
    <div class="field-holder">
        <button class="btn btn-success float-right" type="button" id="open-cate-form"><i class="fa fa-plus"></i> Add Category </button>
    </div>
    
    <form id="add-new-cate-form" class="form" style="display:none;">
        <div class="field-holder">
            <a class=" float-right red" id="close-cate-form" type="button"><i class="fa fa-times"></i></a>
        </div>
        <div class="field-holder">
            <div class="mt-2 mb-1"><label for="category-category">Category</label></div>
            <input required="required" type="text" name="category-name" class="form-field required" id="category-name" placeholder="Menu Category title" value=""/>
        </div>
        <div class="field-holder">
            <div class="mt-2 mb-1"><label for="category-description">Description</label></div>
            <textarea class="form-field" name="category-description" id="category-description" placeholder="Menu category description"></textarea>
        </div>
        <div class="field-holder">
            <button id="add_category" class="btn btn-success float-right" type="button"><i class="fa fa-plus-circle"></i> Save Category </button>
        </div>
    </form>
</div>
<div class="clearfix">&nbsp;</div>

<!--    ////////////////    cagtegories list section  started /////////////////////////////////  -->
<ul id="ez_categoreies_ul"></ul>
<!--    ////////////////    cagtegories list section  ended /////////////////////////////////  -->