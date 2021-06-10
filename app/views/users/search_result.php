
    <?php
    if (isset($data['acceptedUsers'])) {
        ?>


        <?php
        if (!$data['acceptedUsers']) {
            echo "<h3 class='empty'>No request registered</h3>";
        } else {
            foreach ($data['acceptedUsers'] as $user) {
                ?>
                <div class="col-12 row pr-0 pl-0">
                    <div class="col-sm-12 col-md-2"><span class="d-sm-inline-flex d-md-none">Username : </span>
                        <div style="display: block;padding: 1px 15px;"><?=ucfirst($user->username)?></div>
                    </div>

                    <div class="col-sm-12 col-md-8"><span
                                class="d-sm-inline-flex d-md-none">Email : </span> <?= $user->email ?>
                    </div>
                    <div class="col-sm-12 col-md-2"><span
                                class="d-sm-inline-flex d-md-none">Increase Balance : </span> <img class="operation-btn add-btn" data-uid="<?= $user->u_id ?>" data-uname="<?= $user->username ?>" src="<?= URLROOT ?>/img/add.png" alt="" width="40">
                    </div>
                </div>
                <?php
            }//End for each
        }


    } elseif (isset($data['error'])) {
        ?>
        <h1 style="text-align: center;color: #fff;"><?= $data['error'] ?></h1>
        <?php
    }
    ?>

    <script>
        $('.add-btn').click(function () {
            var uid = $(this).data("uid");
            var csrf = "<?php echo ($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : ''; ?>";
            var uname = $(this).data("uname");
            Swal.mixin({
                input: 'text',
                confirmButtonText: 'Next',
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                progressSteps: ['1', '2']
            }).queue([
                {
                    title: 'Increase Balance to ' + uname,
                    text: 'Enter Balance'
                },
                {
                    title: 'Increase Balance to ' + uname,
                    text: 'Enter the reason'
                },

            ]).then((result) => {
                    if (result.value) {
                        return new Promise(function (resolve) {
                            $(".load").show();
                            jQuery.ajax({
                                url: '/shop/add_gift',
                                type: 'POST',
                                data: "add=" + result.value + "&uid=" + uid + "&token=" + csrf+"&uname="+uname,
                                dataType: 'json'
                            })
                                .done(function (response) {
                                    $(".load").hide();
                                    Swal.fire({
                                        type: response.status,
                                        title: response.title,
                                        text: response.message,
                                    })

                                })

                                .fail(function () {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Oops',
                                        text: 'Something went wrong, please contact to Supporter',
                                    })
                                });
                        });
                    }
                }
            )
        });

    </script>


