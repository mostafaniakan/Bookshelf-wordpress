<button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#login">
    ورود
</button>
<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ورود</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="login_user">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="name" class="form-label">نام کاربری </label>
                            <input type="text" class="form-control" id="name_login" placeholder="نام کاربری ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="brand" class="form-label">رمز عبور</label>
                            <input type="text" class="form-control" id="password_login" placeholder="رمز عبور ...">
                        </div>

                    </div>
                    <input type="hidden" id="login-user-nonce" value="<?= wp_create_nonce() ?>">
            </div>
            <div class="modal-footer mt-4">
                <button type="submit" class="btn btn-success">ورود</button>
            </div>
            </form>


        </div>
    </div>
</div>
</div>