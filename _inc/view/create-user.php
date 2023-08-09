<button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#sign-in">
    ثبت نام
</button>
<!-- Modal -->
<div class="modal fade" id="sign-in" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ثبت نام</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form action="" id="create_user">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="first_name" class="form-label">نام </label>
                            <input type="text" class="form-control" id="first_name"
                                   placeholder="نام کاربری ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="last_name" class="form-label">نام خانوادگی </label>
                            <input type="text" class="form-control" id="last_name" placeholder="نام کاربری ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="user_name" class="form-label">نام کاربری </label>
                            <input type="text" class="form-control" id="user_name" placeholder="نام کاربری ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="brand" class="form-label">رمز عبور</label>
                            <input type="password" class="form-control" id="password"
                                   placeholder="رمز عبور ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="model" class="form-label">ایمیل</label>
                            <input type="email" class="form-control" id="email" placeholder="ایمیل ...">
                        </div>
                    </div>
                    <input type="hidden" id="add-create-user-nonce" value="<?= wp_create_nonce() ?>">
            </div>
            <div class="modal-footer mt-4">
                <button type="submit" class="btn btn-success">افزودن</button>
            </div>
            </form>


        </div>
    </div>
</div>
</div>