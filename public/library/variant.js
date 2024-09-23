(function ($) {
    "use strict";
    var HT = {};

    HT.addAttribute = () => {
        $(document).on('click', '.addAttribute', function () {
            let html = HT.renderAttribute(attributeCatalogue);
            $('.variant-body').append(html);
            $('.setupSelect2').select2();
        });
    }

    HT.renderAttribute = (attributeCatalogue) => {
        let html = '';
        html += '<div class="row variant-item mtp10">';
        html += '<div class="col-lg-3">';
        html += '<div class="attribute-catalogue">';
        html += '<select name="attribute_catalogue_id" class="choose-attribute setupSelect2">';
        html += '<option value="">Chọn Nhóm thuộc tính</option>';
        for (let i = 0; i < attributeCatalogue.length; i++) {
            html += '<option value="' + attributeCatalogue[i].id + '">' + attributeCatalogue[i].name + '</option>';
        }
        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-8">';
        html += '<select class="selectVariant form-control" name="attribute[]" data-catid=""></select>';
        html += '</div>';
        html += '<div class="col-lg-1">';
        html += '<button type="button" class="remove-attribute btn btn-danger"><i class="fa fa-trash deleteattribute"><i/></button>';
        html += '</div>';
        html += '</div>';

        return html;
    }

    HT.removeAttribute = () => {
        $(document).on('click', '.remove-attribute', function () {
            let _this = $(this);
            _this.parents('.variant-item').remove();
        });
    }

    HT.select2Variant = (attributeCatalogueId) => {
        let html = '<select class="selectVariant form-control" name="attribute[' + attributeCatalogueId + '][]" data-catid="' + attributeCatalogueId + '"></select>';
        return html;
    }

    HT.chooseVariantGroup = () => {
        $(document).on('change', '.choose-attribute', function() {
            let _this = $(this);
            let attributeCatalogueId = _this.val();
            let $selectVariant = _this.parents('.row').find('.selectVariant');

            if(attributeCatalogueId !== '') {
                $.ajax({
                    url: '/ajax/attribute/getAttribute',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        option: {
                            attributeCatalogueId: attributeCatalogueId
                        }
                    },
                    success: function(response) {
                        let htmlOptions = '<option value="">Chọn Thuộc tính</option>';
                        response.items.forEach(function(item) {
                            htmlOptions += '<option value="' + item.id + '">' + item.text + '</option>';
                        });

                        $selectVariant.html(htmlOptions).select2();
                    }
                });
            } else {
                $selectVariant.html('<option value="">Chọn Thuộc tính</option>');
            }
        });
    }


    $(document).ready(function() {
        HT.addAttribute();
        HT.removeAttribute();
        HT.chooseVariantGroup();
    });

})(jQuery);
