<!--                create post-->
<button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#sign-in">
    ایجاد پست
</button>
<!-- Modal -->
<div class="modal fade" id="sign-in" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ایجاد پست</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form action="" id="create_post" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="first_name" class="form-label"> نام کتاب </label>
                            <input type="text" class="form-control" name="title_post" id="title_post"
                                   placeholder="نام کتاب ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="last_name" class="form-label">نویسنده </label>
                            <input type="text" class="form-control" name="author_post" id="author_post"
                                   placeholder="نویسنده ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="user_name" class="form-label">ژانر </label>
                            <input type="text" class="form-control" name="genre_post" id="genre_post"
                                   placeholder="ژانر ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="brand" class="form-label">تاریخ چاپ</label>
                            <input type="date" class="form-control" name="publication_year"
                                   id="publication_year"
                                   placeholder="تاریخ چاپ ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="model" class="form-label">انتخاب عکس</label>
                            <input type="file" name="file_img" class="form-control" id="file_img"
                                   accept="image/*" placeholder="انتخاب عکس ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="model" class="form-label">درباره کتاب</label>
                            <textarea type="text" class="form-control" name="excerpt" id="excerpt"
                                      placeholder="درباره کتاب ..."></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="add-create-user-nonce" value="<?= wp_create_nonce() ?>">
            </div>
            <div class="modal-footer mt-4">
                <button type="submit" class="btn btn-success">ایجاد پست جدید</button>
            </div>
            </form>


        </div>
    </div>
</div>