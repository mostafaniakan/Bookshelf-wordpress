<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">آپدیت پست</h5>
        </div>
        <div class="modal-body">


            <form action="" id="update_post" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label for="first_name" class="form-label"> نام کتاب </label>
                        <input type="text" value="<?= $query_get_post[0]->title ?>" class="form-control"
                               name="title_post" id="title_post_update"
                               placeholder="نام کتاب ...">
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label for="last_name" class="form-label">نویسنده </label>
                        <input type="text" value="<?= $query_get_post[0]->author ?>" class="form-control"
                               name="author_post" id="author_post_update"
                               placeholder="نویسنده ...">
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label for="user_name" class="form-label">ژانر </label>
                        <input type="text" value="<?= $query_get_post[0]->genre ?>" class="form-control"
                               name="genre_post" id="genre_post_update"
                               placeholder="ژانر ...">
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label for="brand" class="form-label">تاریخ چاپ</label>
                        <input type="date" value="<?= $query_get_post[0]->publication_year ?>"
                               class="form-control" name="publication_year"
                               id="publication_year_update"
                               placeholder="تاریخ چاپ ...">
                    </div>
                    <input type="text" value="<?= $book_id_query ?>" hidden name="id_update" id="id_update"
                           placeholder="تاریخ چاپ ...">
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label for="model" class="form-label">انتخاب عکس</label>
                        <input type="file" value="<?= $query_get_post[0]->image ?>" name="file_img"
                               class="form-control" id="file_img_update"
                               accept="image/*" placeholder="انتخاب عکس ...">
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label for="model" class="form-label">درباره کتاب</label>
                        <textarea type="text" class="form-control" name="excerpt" id="excerpt_update"
                                  placeholder="درباره کتاب ..."><?= $query_get_post[0]->excerpt ?></textarea>
                    </div>
                </div>
        </div>
        <div class="modal-footer mt-4">
            <button type="submit" class="btn btn-success">اپدیت</button>
        </div>
        </form>
    </div>
</div>