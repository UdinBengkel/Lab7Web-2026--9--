<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
    <style>
        #login-wrapper {
            max-width: 400px;
            margin: 60px auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        #login-wrapper h1 {
            margin-bottom: 20px;
            color: #1e3a5f;
            font-size: 22px;
        }
        .mb-3 { margin-bottom: 15px; }
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 13px;
        }
        .form-control {
            width: 100%;
            padding: 9px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .alert { padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 13px; }
        .alert-danger { background: #fdecea; border: 1px solid #e57373; color: #c62828; }
    </style>
</head>
<body>
    <div id="login-wrapper">
        <h1>Sign In</h1>

        <?php if (session()->getFlashdata('flash_msg')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('flash_msg'); ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="mb-3">
                <label for="InputForEmail" class="form-label">Email Address</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       id="InputForEmail"
                       value="<?= set_value('email'); ?>">
            </div>
            <div class="mb-3">
                <label for="InputForPassword" class="form-label">Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       id="InputForPassword">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>