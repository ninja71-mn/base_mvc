<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="main">

    <div class="row">
        <div class="col-sm-6 col-12 mr-auto ml-auto register">
            <h2>ساخت حساب کاربری</h2>
            <p>لطفا جهت ثبت نام فرم زیر را تکمیل فرمایید</p>
            <form action="<?= URLROOT ?>/users/register" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="username">نام کاربری : <sup>*</sup></label>
                    <input type="text" name="username"
                           class="form-control form-control-lg <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>"
                           value="<?= $data['username'] ?>">
                    <span class="invalid-feedback"><?= $data['username_err'] ?></span>
                </div>
                <div class="form-group">
                    <label for="email">ایمیل : <sup>*</sup></label>
                    <input type="email" name="email"
                           class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                           value="<?= $data['email'] ?>">
                    <span class="invalid-feedback"><?= $data['email_err'] ?></span>
                </div>
                <div class="form-group">
                    <label for="password">رمز عبور : <sup>*</sup></label>
                    <input type="password" name="password"
                           class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                           value="<?= $data['password'] ?>">
                    <span class="invalid-feedback"><?= $data['password_err'] ?></span>
                </div>
                <div class="form-group">
                    <label for="confirm_password">تایید رمز عبور : <sup>*</sup></label>
                    <input type="password" name="confirm_password"
                           class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>"
                           value="<?= $data['confirm_password'] ?>">
                    <span class="invalid-feedback"><?= $data['confirm_password_err'] ?></span>
                </div>
                <div class="custom-control custom-checkbox" style="margin-bottom: 25px">
                    <input type="checkbox" class="custom-control-input" id="rules" name="rules" required>
                    <label class="custom-control-label" for="rules" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;من تمام قوانین را خوانده و می پذیرم</label>
                </div>

                <div class="form-group rule hide">
                    <p>شما قوانین را پذیرفتید</p>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="ثبت نام" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?= URLROOT ?>/users/login" class="btn btn-light btn-block">ورود</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
