var repeatableFormField = function () {
    var selectors = {
            repeatableContainers : '.repeatable-container',
            repeatableUnit       : '.repeatable__unit',
            controlAdd           : '.repeatable__control-add',
            controlRemove        : '.repeatable__control-remove'
        },
        options   = {

        },
        classes   = {
            removing : 'removing'
        },
        $repeatabls = [],
        that = this;


    var refreshNameAttributes = function ($repeatableContainer, template) {
        var $tmpl = jQuery(template),
            $rows = $repeatableContainer.find(selectors.repeatableUnit),
            counter = 0,
            fieldNames = [],
            regex =/\[.*?]/i,
            tempReplace = '[]';

        // find all the fields in the row, log their names and replace the array expression
        jQuery.each($tmpl.find('input, select, textarea'), function (index, element) {
            var name = jQuery(element).attr('name');
            fieldNames.push(jQuery(element).attr('name').replace(regex, tempReplace));
        });

        // iterate over all the rows now in existence on this repeatable
        $rows.each(function (index, row){
            // and for each of their fields
            jQuery(row).find('input, select, textarea').each(function (index, field){
                // update the replaced value with an array expression, with a proper counter
                var name = jQuery(field).attr('name');
                jQuery(field).attr('name', name.replace(tempReplace, '[' + counter  + ']'));

            });

            // increase this counter for each row
            counter = +counter + 1;
        });


    };

    var bindAdd  = function ($addButton, $repeatableContainer, template) {
        $addButton.on('click', function (e){
            var $el, $newAddButton, $newRemoveButton;
            e.stopPropagation();
            e.preventDefault();

            // append template to container
            $el = jQuery(template);
            $el.css('display', 'none');
            $repeatableContainer.append($el);
            $el.slideDown();

            // bind add and remove buttons
            $newAddButton    = $el.find(selectors.controlAdd);
            $newRemoveButton = $el.find(selectors.controlRemove);

            bindAdd($newAddButton, $repeatableContainer, template);
            bindRemove($newRemoveButton, $el, $repeatableContainer);

            // set the name attributes correctly
            refreshNameAttributes($repeatableContainer, template);
            return false;
        });


    };

    var bindRemove  = function ($removeButton, $removable, $repeatableContainer) {
        // on click
            // remove the $removeable
        $removeButton.on('click', function (e) {
            e.stopPropagation();
            e.preventDefault();




            if($repeatableContainer.find(selectors.repeatableUnit).not('.' + classes.removing).length < 2) {
                return false;
            }

            $removable.addClass(classes.removing);

            $removable.slideUp(200, function (){
                $removable.remove();
            });


            return false;
        });
    };

    this.initRepeatable = function (index, $repeatable){


        var $repeatableUnit             = $repeatable.children(selectors.repeatableUnit).first(),
            $repeatableUnitClone        = $repeatableUnit.clone(),
            $addButton                  = $repeatableUnit.find(selectors.controlAdd),
            $removeButton               = $repeatableUnit.find(selectors.controlRemove),
            template;

        // empty the inputs
        $repeatableUnitClone.children('input, select, textarea').val(null);
        template = jQuery('<div>').append($repeatableUnitClone).html();


        // bind add Button
        bindAdd($addButton, $repeatable, template);

        // bind remove button
        bindRemove($removeButton, $repeatableUnit, $repeatable);

        refreshNameAttributes($repeatable, template);
    };

    this.initAllRepeatabls = function () {
        jQuery.each($repeatabls, function (index, $repeatable) {
            that.initRepeatable(index, $repeatable, $repeatable);
        });
    };

    this.findRepeatabls = function () {
        var $repetable = jQuery(selectors.repeatableContainers);

        jQuery.each($repetable, function (index, rep) {
            $repeatabls.push(jQuery(rep));
        });
    };

    this.init = function () {
        that.findRepeatabls();
        that.initAllRepeatabls();
    };

    return this;
};

jQuery(document).ready(function (){
    var repeatable = new repeatableFormField();
    repeatable.init();
});