<!DOCTYPE html>
<html lang="en">

<head>
    <title>Coming Soon</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= base_url(); ?>/comingsoon/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/comingsoon/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/comingsoon/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/comingsoon/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/comingsoon/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/comingsoon/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/comingsoon/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/comingsoon/css/main.css">
    <!--===============================================================================================-->
</head>

<body>


    <div class="bg-g1 size1 flex-w flex-col-c-sb p-l-15 p-r-15 p-t-55 p-b-35 respon1">
        <span></span>
        <div class="flex-col-c p-t-50 p-b-50">
            <h3 class="l1-txt1 txt-center p-b-10">
                Coming Soon
            </h3>

            <p class="txt-center l1-txt2 p-b-60">
                Our website is under construction
            </p>

            <div class="flex-w flex-c cd100 p-b-82">
                <div class="flex-col-c-m size2 how-countdown">
                    <span class="l1-txt3 p-b-9 days">35</span>
                    <span class="s1-txt1">Days</span>
                </div>

                <div class="flex-col-c-m size2 how-countdown">
                    <span class="l1-txt3 p-b-9 hours">17</span>
                    <span class="s1-txt1">Hours</span>
                </div>

                <div class="flex-col-c-m size2 how-countdown">
                    <span class="l1-txt3 p-b-9 minutes">50</span>
                    <span class="s1-txt1">Minutes</span>
                </div>

                <div class="flex-col-c-m size2 how-countdown">
                    <span class="l1-txt3 p-b-9 seconds">39</span>
                    <span class="s1-txt1">Seconds</span>
                </div>
            </div>

            <?php if (in_groups('admin')) { ?>
                <a href="<?= base_url(); ?>/Admin" class="flex-c-m s1-txt2 size3 how-btn">
                    Back to Website
                </a>
            <?php } elseif (in_groups('operator')) { ?>
                <a href="<?= base_url(); ?>/Operator" class="flex-c-m s1-txt2 size3 how-btn">
                    Back to Website
                </a>
            <?php } elseif (in_groups('siswa')) { ?>
                <a href="<?= base_url(); ?>/Siswa" class="flex-c-m s1-txt2 size3 how-btn">
                    Back to Website
                </a>
            <?php } elseif (in_groups('guru')) { ?>
                <a href="<?= base_url(); ?>/Guru" class="flex-c-m s1-txt2 size3 how-btn">
                    Back to Website
                </a>
            <?php } elseif (in_groups('kepalasekolah')) { ?>
                <a href="<?= base_url(); ?>/Kepalasekolah" class="flex-c-m s1-txt2 size3 how-btn">
                    Back to Website
                </a>
            <?php } ?>

        </div>

        <span class="s1-txt3 txt-center">
            @ 2021 Coming Soon Suzuran
        </span>

    </div>

    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>/comingsoon/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>/comingsoon/vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url(); ?>/comingsoon/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>/comingsoon/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>/comingsoon/vendor/countdowntime/moment.min.js"></script>
    <script src="<?= base_url(); ?>/comingsoon/vendor/countdowntime/moment-timezone.min.js"></script>
    <script src="<?= base_url(); ?>/comingsoon/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
    <script src="<?= base_url(); ?>/comingsoon/vendor/countdowntime/countdowntime.js"></script>
    <script>
        $('.cd100').countdown100({
            // Set Endtime here
            // Endtime must be > current time
            endtimeYear: 0,
            endtimeMonth: 0,
            endtimeDate: 35,
            endtimeHours: 18,
            endtimeMinutes: 0,
            endtimeSeconds: 0,
            timeZone: ""
            // ex:  timeZone: "America/New_York", can be empty
            // go to " http://momentjs.com/timezone/ " to get timezone
        });
    </script>

    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>/comingsoon/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>/comingsoon/js/main.js"></script>

</body>

</html>