<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- bootstrap JS -->
    <script src="/js/bootstrap.bundle.js"></script>
    <title>Login</title>
</head>
<body style="display: grid; place-items: center; min-height:100vh; background-color: #eee;">
    <div class="bg-white px-5 py-3 w-75 rounded-4" style="max-width: 600px;">
        <h3 class="">Login</h3>
        <hr>
        <form action="/login" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control <?= error('email') ? 'is-invalid' : '' ?>"
                    value="<?= old('email') ?>"
                >
                <!-- validation message -->
                <?php if(error('email')) : ?>
                    <small class="invalid-feedback"><?= error('email') ?></small>
                <?php endif ; ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="form-control <?= error('password') ? 'is-invalid' : '' ?>"
                >
                <!-- validation message -->
                <?php if(error('password')) : ?>
                    <small class="invalid-feedback"><?= error('password') ?></small>
                <?php endif ; ?>
            </div>
            <button class="float-end btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>