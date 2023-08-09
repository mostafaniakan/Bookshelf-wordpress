<?php get_header()?>
<button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#my_post">
    پست های من
</button>
<!-- Modal -->
<div class="modal fade" id="my_post" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">پست های پسندیده</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body like-book-body">

                <?php $books = get_my_books();
                if ($books): ?>
                    <?php foreach ($books as $books): ?>

                        <div class="card card_like">
                            <?php
                            if ($books->image):
                                ?>

                                <img class="img-fluid" src="<?= $books->image ?>"
                                     alt="image">
                            <?php else: ?>
                                <img class="img-fluid"
                                     src="https://hackr.io/blog/what-is-programming-language/thumbnail/large"
                                     alt="image">
                            <?php endif; ?>

                            <h3 class="title" data-title="<?= $books->title?>" ><a> <?php echo $books->title ?></a></h3>
                            <p><?= $books->author . " " ?> نویسنده:</p>
                            <p><?= $books->publication_year . " " ?> تاریخ انتشار:</p>
                            <p><?= $books->genre . " " ?> ژانر:</p>
                            <p><?= $books->excerpt . " " ?> خلاصه:</p>

                            <div class="like">
                                <svg class="like_post <?php
                                $post_like = check_like($books->id);
                                if ($post_like > 0) {
                                    echo 'like_active';
                                }
                                ?>" id="like" data-id="<?= $books->id ?>" title="Like undefined SVG File" width="21"
                                     height="21"
                                     viewBox="0 0 24 24" fill="none" stroke="#8899a4" stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                                            <h2>
                                                <a href="<?= get_permalink() . 'update?book_id=' . $books->id ?>">ویرایش</a>
                                            </h2>
                            </div>

                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-danger">هیچ کتابی پسند نشده</div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>
</div>