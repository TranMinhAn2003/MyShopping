(function ($) {
    "use strict";
    var HT = {};

    HT.setupEditor = () => {

        $('.ck_editor').each(function () {
            let editor = $(this);
            let elementId = editor.attr('id');
            HT.ckeditor(elementId);
        });
    }

    HT.ckeditor = (elementId) => {
        CKEDITOR.replace(elementId, {
            autoUpdateElement: true,
            height: 200,
            removeButtons: '',
            entities: true,
            allowedContent: true,
            toolbar: [
                { name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
                { name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'] },
                '/',
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'] },
                { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
                '/',
                { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
            ]
        });
    }
    HT.uploadImage=()=>{
        $('.update_image').click(function (){
        let input=$(this)
        let type=input.attr('data-type')
            HT.setupCkFinder2(input,type);
        })
    }

    HT.setupCkFinder2 =(object,type)=>{
       if(typeof(type)=='undefined'){
           type='Images';
       }
       var finder = new CKFinder();
       finder.resourceType = type;

       finder.selectActionFunction = function (fileUrl,data) {
         object.val(fileUrl)
       }
       finder.popup();
    }
    $(document).ready(function (){
        HT.uploadImage();
        HT.setupEditor();
    })
})(jQuery);
