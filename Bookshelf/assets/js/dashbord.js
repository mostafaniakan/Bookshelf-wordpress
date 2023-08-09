jQuery(document).ready(function ($) {
    $('#create_user').on('submit', function (e) {
        e.preventDefault();
        let user_name = $('#user_name').val();
        let password = $('#password').val();
        let email = $('#email').val();
        let first_name = $('#first_name').val();
        let last_name = $('#last_name').val();

        $.ajax({
            url: ajax.ajax_url,
            type: "post",
            data: {
                action: "wp_add_users",
                first_name: first_name,
                last_name: last_name,
                user_name: user_name,
                email: email,
                password: password,
                nonce: ajax._nonce,
            },
            beforeSend: function () {
            },
            success: function (response) {
                if (response.success) {
                    console.log(response.success);
                    if (response.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
                setTimeout(() => {
                    window.location.href = window.location;
                }, 2000);
            },
            error: function (error) {
                if (error.error) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: error.responseJSON.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            complete: function () {
            },
        });
    })
    $('#login_user').on('submit', function (e) {
        e.preventDefault();
        let user_name = $('#name_login').val();
        let password = $('#password_login').val();
        $.ajax({
            url: ajax.ajax_url,
            type: "post",
            data: {
                action: "wp_login_user",
                user_name: user_name,
                password: password,
                nonce: ajax._nonce,
            },
            beforeSend: function () {
            },
            success: function (response) {
                console.log(response.success);
                if (response.success) {

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                setTimeout(() => {
                    window.location.href = window.location;
                }, 2000);

            },
            error: function (error) {

                if (error.error) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: error.responseJSON.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
            },
            complete: function () {
            },
        });

    })
    $('#create_post').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append('file_img', $('#file_img')[0].files[0]);
        formData.append('publication_year', $('#publication_year').val());
        formData.append('excerpt', $('#excerpt').val());
        formData.append('genre_post', $('#genre_post').val());
        formData.append('author_post', $('#author_post').val());
        formData.append('title_post', $('#title_post').val());
        formData.append('action', 'wp_create_post');
        formData.append('nonce', ajax._nonce);
        console.log(formData.get('genre_post'));

        $.ajax({
            url: ajax.ajax_url,
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
            },
            success: function (response) {
                if (response.success) {
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
                setTimeout(() => {
                    window.location.href = window.location;
                }, 2000);
            },
            error: function (error) {
                if (error.error) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: error.responseJSON.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            complete: function () {
            },
        });

    })
    $('.like_post').on("click", function () {
        let el = $(this);
        el.toggleClass('like_active');
        let post_id = el.data('id')
        if (el.hasClass("like_active")) {
            console.log(post_id);
            $.ajax(
                {
                    url: ajax.ajax_url,
                    type: "post",
                    data: {
                        action: 'wp_add_like',
                        post_id: post_id,
                    }
                }
            )
        } else {
            el.closest('.card_like').addClass('hidden_post_like');
            $.ajax(
                {
                    url: ajax.ajax_url,
                    type: "post",
                    data: {
                        action: 'wp_delete_like',
                        post_id: post_id,
                    }
                },
            )
        }
    })

    $('#update_post').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('post_id', $('#id_update').val());
        formData.append('publication_year', $('#publication_year_update').val());
        formData.append('excerpt', $('#excerpt_update').val());
        formData.append('genre_post', $('#genre_post_update').val());
        formData.append('author_post', $('#author_post_update').val());
        formData.append('title_post', $('#title_post_update').val());
        formData.append('file_img', $('#file_img_update')[0].files[0]);
        formData.append('action', 'wp_update_book');
        formData.append('nonce', ajax._nonce);
        $.ajax({
            url: ajax.ajax_url,
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
            },
            success: function (response) {
                if (response.success) {
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
                setTimeout(() => {
                    window.location.href = window.location.origin;
                }, 2000);
            },
            error: function (error) {
                if (error.error && error.responseJSON.msg !== "") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: error.responseJSON.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'تغییری ایجاد نشده',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            complete: function () {
            },
        });
    })

    $('.copy_link').on("click", function () {
        let el = $(this);
        let url = el.data('url');
        navigator.clipboard.writeText(url);
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'لینک با موفقیت کپی شد',
            showConfirmButton: false,
            timer: 1500
        })

    })

})
