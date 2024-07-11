(function ($){
    "use strict";
    var HT={};
    var _token = $('meta[name="csrf-token"]').attr('content')

        HT.switchery=()=>{
        $('.js-switch').each(function (){
            var switchery = new Switchery(this, {color: '#1AB394'});
        })
        }
        HT.select2=()=>{
        $('.setupSelect2').select2();
        }
        HT.changeStatus=()=>{
        if($('.status').length){
            $(document).on('change','.status',function (e){
                let _this= $(this)

                let option={
                    'value' : _this.val(),
                    'modelId' : _this.attr('data-modelId'),
                    'model' :_this.attr('data-model'),
                    'field' : _this.attr('data-field'),

                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'ajax/dashboard/changeStatus',
                    type: 'POST',
                    data: option,
                    datatype: 'json',
                    success: function (res) {
                       console.log(res)
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                    }
                });
                e.preventDefault()
            })
        }
        }
    HT.checkAll=()=>{
        if($('#checkAll').length){
            $(document).on('click','#checkAll',function (){
                let isCheck = $(this).prop('checked');
                $('.item').prop('checked',isCheck);
                $('.item').each(function (){
                    let _this=$(this);
                    HT.changeBackground(_this);
                });
            });
        }
    }

    HT.checkItem=()=>{
        if($('.item').length){
            $(document).on('click','.item',function (){
                let _this=$(this);
                HT.changeBackground(_this);
                HT.allcheck();
            });
        }
    }

    HT.changeBackground=(object)=>{
        let isCheck=object.prop('checked');
        if(isCheck){
            object.closest('tr').addClass('active-bg');
        }else{
            object.closest('tr').removeClass('active-bg');
        }
    }

    HT.allcheck=()=>{
        let allChecked = $('.item').length === $('.item:checked').length;
        $('#checkAll').prop('checked', allChecked);
    }


    $(document).ready(function (){
        HT.switchery();
        HT.select2();
        HT.changeStatus();
        HT.checkAll();
        HT.checkItem();
        HT.allcheck();

    });
})(jQuery);
