import $ from 'jquery';
import 'popper.js/dist/popper.js';
import 'bootstrap/dist/js/bootstrap.min.js';
import 'bootstrap/dist/js/bootstrap.bundle.min';

    $(document).ready(function () {

        const class_show_password = $('.icon_show_password');
        const form_block = $('#registration_form');
        const main_block = $('.card');
        const class_hide_password = $('.icon_hide_password');
        const input_class = $('input');
        const lock_button = $('.ajax_enable');
        const button_send_form = $('.send_form');
        const loader = $('.spinner-border-custom');
        const alert_ok = $('.alert_ok');
        const alert_error = $('.alerts-bl-error');
        const alert_error_message = $('.content-error');
        const alert_error_close = $('.close_error_block');
        const alert_block = $('.alerts-bl');
        const rules = {
            email:{ required:true, type:'email'},
            first_name:{ required: true, type:'text'},
            last_name:{ required: true, type:'text'},
            password:{required: true, type:'password'},
            confirm_password:{required: true, type:'password'},
        }

        const showHideError = (class_block,show = true) =>{
            $(class_block).each(function () {
                $(this).css({display: !show ? 'none' : 'block'});
            });
        };

        const showPass = (e) => {
            e.css({visibility: 'hidden'});
            $(e.siblings('input')).attr('type', 'text');
            e.siblings(class_hide_password).css({visibility: 'visible'});
        };

        const hidePass = (e) =>{
            e.css({visibility:'hidden'});
            $(e.siblings('input')).attr('type','password');
            e.siblings(class_show_password).css({visibility:'visible'});
        };

        const callBackSaveUser = (request) => {

            if (request.status == false) {

                let text = '';

                if (request.error == 'email_exists') {
                    text = 'This email already exists';
                } else {
                    for (const error of  request.error){
                        activeError(error.name,error.error);
                    }
                    text = 'Field filling error';
                }

                showAlertsError(text);
            }

            if (request.status == true ) {
                alert_ok.css({opacity:1});
                showHideError(alert_block, true);
                showHideError(main_block, false);
            }
        };

        const showAlertsError = (text) => {
            alert_error.show();
            setTimeout(function (){
                alert_error.hide();
            },50000);
            alert_error_message.text(text);
        };

        alert_error_close.on('click',function(){
            alert_error.hide();
        });

        const customValidator = (data) => {
            if (rules.hasOwnProperty(data.name)) {
                let get_rules = rules[data.name];

                if (get_rules.hasOwnProperty('required') && get_rules.required == true) {
                    if (data.value.length == 0) {
                        return {status:false, type:'empty_field'};
                    }
                }

                if (data.value != '' || data.required == true) {
                    if (get_rules.type == 'email' ) {
                        if(!(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/.test(data.value))){
                            return {status:false, type:'invalid_field'};
                        }
                    }
                }
                return {status:true};
            }
            return {status:false, type:'no_fields_in_rules'};
        };

        const activeError = (field_name, type ) => {
            let error_class = `error_${field_name}`;
            showAlertsError('Field filling error');
            switch (type) {
                case "no_fields_in_rules":
                    console.log('no field in rules validator '+field_name);
                    break;
                case "empty_field":
                    showHideError(`.${error_class}_required` , true);
                    break;
                case 'invalid_field':
                    showHideError(`.${error_class}_invalid` , true);
                    break;
                case 'error_password_coincidence':
                    showHideError(`.${error_class}_coincidence` , true);
                    break;
            }
        };

        const ajax = (data,url,callback) => {
            $.ajax({
                type: 'POST',
                data: data,
                url: url,
                dataType: "json",
                success: function (data) {
                    callback(data);
                },
                error: function (error) {
                    callback(error);
                },
            })
        };

        input_class.focus(function (){
            $(this).parents('.mb-3').find('.error').each(function (){
                $(this).css({display:'none'});
            });
        });

        class_show_password.on('click',function (e){
            showPass($(e.target));
        });

        class_hide_password.on('click',function (e) {
            hidePass($(e.target));
        });

        form_block.submit(function (e){
            e.preventDefault();
            let data = $(this).serializeArray();
            let value = {};
            let status = true;
            for( let arr of data ) {
                let res = customValidator(arr);
                if (!res.status) {
                    activeError(arr.name,res.type);
                    value = {};
                    status = false;
                } else {
                    value[arr.name] = $(`input[name="${arr.name}"]`).val();
                }
            }
            if (Object.keys(value).length > 1 && status) {
                if (value.password != value.confirm_password) {
                    activeError('password','error_password_coincidence');
                    activeError('confirm_password','error_password_coincidence');
                    return 0;
                }
                ajax(
                    value,
                    '/save_user',
                    callBackSaveUser
                );
            }
        });

        $(document).ajaxStart(function () {
            showHideError(lock_button,true);
            showHideError(button_send_form,false);
            showHideError(loader,true);
            loader.css({visibility:'visible'});
        }).ajaxStop(function () {
            showHideError(lock_button,false);
            showHideError(button_send_form,true);
            loader.css({visibility:'hidden'});
        });
    });
