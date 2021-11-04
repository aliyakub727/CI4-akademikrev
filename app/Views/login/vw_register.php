<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        @import "https://use.fontawesome.com/releases/v5.5.0/css/all.css";

        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: url(img/bge.jpg) no-repeat;
            background-size: cover;
        }

        .login-box {
            width: 280px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }

        .login-box h1 {
            float: left;
            font-size: 40px;
            border-bottom: 6px solid #4caf50;
            margin-bottom: 50px;
            padding: 13px 0;
        }

        .textbox {
            width: 100%;
            overflow: hidden;
            font-size: 20px;
            padding: 8px 0;
            margin: 8px 0;
            border-bottom: 1px solid #4caf50;
        }

        .textbox i {
            width: 26px;
            float: left;
            text-align: center;
        }

        .textbox input {
            border: none;
            outline: none;
            background: none;
            color: white;
            font-size: 18px;
            width: 80%;
            float: left;
            margin: 0 10px;
        }

        .btn {
            width: 100%;
            background: none;
            border: 2px solid #4caf50;
            color: white;
            padding: 5px;
            font-size: 18px;
            cursor: pointer;
            margin: 12px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <?= view('Myth\Auth\Views\_message_block') ?>
            <form action="<?= route_to('register') ?>" method="post">
                <?= csrf_field() ?>
                <div class="row  ml-4 mt-4">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="email"><?= lang('Auth.email') ?></label>
                            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                            <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="username"><?= lang('Auth.username') ?></label>
                            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                        </div>
                    </div>
                </div>
                <div class="row  ml-4 mt-1">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                            <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-5  ml-4 mt-1">
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-select form-control" name="kesaktian" id="kesaktian">
                            <option readonly selected>Pilih nama Role</option>
                            <option value="admin">Administrasi</option>
                            <option value="operator">Operator</option>
                            <option value="guru">Guru</option>
                            <option value="siswa">Siswa</option>
                            <option value="kepala_sekolah">Kepala Sekolah</option>
                        </select>
                    </div>
                </div>
                <div class="col-4 ml-4 mt-1 mb-5">
                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.register') ?></button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>