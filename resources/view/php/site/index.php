
<?php

//$this->updateTitle('123123123123123123');
//$this->addScript([
//        'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'
//]);
//$this->addStyle(['../css/main.css']);
?>

<div class="row reg-form-c">
    <div class=" d-flex justify-content-center align-items-center">
        <div class="alerts-bl">
            <div class="alert alert-success fade alert_ok" role="alert">
                <h4 class="alert-heading">Saved successfully!</h4>
            </div>
        </div>
        <div class="card col-md-6">
            <div class="d-flex justify-content-center spinner-border-custom"aria-hidden="true">
                <div class="spinner-border .spinner-border-ms hide" role="status">
                    <span class="sr-only" style="display: none">Loading...</span>
                </div>
            </div>
            <div class="card-body">
                <div class="alerts-bl-error">
                    <div class="alert alert-danger alert-custom-error hide" role="alert">
                        <span class="content-error"></span>
                        <div class="close_error_block"><i class="bi bi-x"></i></div>
                    </div>
                </div>

                <form id = "registration_form" >
                    <div class="mb-3">
                        <label for="email" class="form-label required">Email address</label>
                        <input type="text" value="" name = "email"  class="form-control" id="email" aria-describedby="emailHelp">
                        <div class="error_block_input">
                            <span class="error error_email_required">required fields</span>
                            <span class="error error_email_invalid">incorrect email</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label required">First Name</label>
                        <input type="text" value="" name="first_name" class="form-control" id="firstName">
                        <div class="error_block_input">
                            <span class="error error_first_name_required">required fields</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label required">Last Name</label>
                        <input type="text" value="" name = "last_name" class="form-control" id="lastName">
                        <div class="error_block_input">
                            <span class="error error_last_name_required">required fields</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label required">Password</label>
                                <div class="b-pass">
                                    <input type="password" value="" name ="password" class="form-control" id="password">
                                    <span class=" bi bi-eye icon_show_password"></span>
                                    <span class=" bi bi-eye-slash icon_hide_password"></span>
                                </div>

                        <div class="error_block_input">
                            <span class="error error_password_required">required fields</span>
                            <span class="error  error_password_coincidence">passwords do not match</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="passwordConf" class="form-label required">Password Confirm</label>
                        <div class="b-pass">
                            <input type="password" value="" name ="confirm_password" class="form-control" id="passwordConf">
                            <span class=" bi bi-eye icon_show_password"></span>
                            <span class=" bi bi-eye-slash icon_hide_password"></span>
                        </div>

                        <div class="error_block_input">
                            <span class="error error_confirm_password_required">required fields</span>
                            <span class="error error_confirm_password_coincidence">passwords do not match</span>
                        </div>
                    </div>

                    <button type="submit"  class="btn btn-primary send_form">Submit</button>

                    <button class="btn btn-primary ajax_enable" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
