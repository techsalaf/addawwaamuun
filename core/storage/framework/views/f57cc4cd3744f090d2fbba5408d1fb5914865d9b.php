<!DOCTYPE html>
<html>
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <title><?php echo e(__('Admin Login') . ' | ' . $websiteInfo->website_title); ?></title>

    
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/img/' . $websiteInfo->favicon)); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/all.min.css')); ?>">

    <style>
      :root {
        --primary: #1866d4;
        --secondary: #580ce3;
        --text-dark: #0f172a;
        --text-secondary: #64748b;
        --text-light: #94a3b8;
        --border: #e2e8f0;
        --shadow-xl: 0 20px 50px -15px rgba(0, 0, 0, 0.15);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }
      body {
        background: #f8fafc;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
        position: relative;
        overflow: hidden;
      }
      body::before {
        content: '';
        position: absolute;
        top: -10%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(24, 102, 212, 0.05) 0%, transparent 70%);
        z-index: 0;
      }
      body::after {
        content: '';
        position: absolute;
        bottom: -10%;
        left: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(88, 12, 227, 0.05) 0%, transparent 70%);
        z-index: 0;
      }
      .login-container {
        width: 100%;
        max-width: 450px;
        padding: 20px;
        position: relative;
        z-index: 1;
      }
      .auth-card {
        background: #fff;
        padding: 40px;
        border-radius: 24px;
        box-shadow: var(--shadow-xl);
        border: 1px solid var(--border);
      }
      .login-logo {
        max-width: 180px;
        margin-bottom: 30px;
      }
      .auth-header h2 {
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 10px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .auth-header p {
        color: var(--text-secondary);
        font-size: 15px;
        margin-bottom: 30px;
      }
      .form_group {
        margin-bottom: 20px;
      }
      .form_group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
      }
      .input-with-icon {
        position: relative;
      }
      .input-with-icon i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        transition: var(--transition);
      }
      .form_control {
        width: 100%;
        height: 55px;
        padding: 10px 20px 10px 50px;
        border-radius: 12px;
        border: 1.5px solid var(--border);
        background: #fff;
        font-size: 15px;
        transition: var(--transition);
        outline: none;
      }
      .form_control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(24, 102, 212, 0.1);
      }
      .form_control:focus + i {
        color: var(--primary);
      }
      .btn-login {
        width: 100%;
        height: 55px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 10px 20px rgba(24, 102, 212, 0.2);
      }
      .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 25px rgba(24, 102, 212, 0.3);
      }
      .forget-link {
        display: block;
        text-align: center;
        margin-top: 25px;
        color: var(--text-secondary);
        font-size: 14px;
        text-decoration: none;
        transition: var(--transition);
      }
      .forget-link:hover {
        color: var(--primary);
      }
      .alert {
        border-radius: 12px;
        margin-bottom: 25px;
        font-size: 14px;
        font-weight: 500;
      }
    </style>
  </head>

  <body>
    <div class="login-container">
      <div class="auth-card">
        <?php if(!empty($websiteInfo->logo)): ?>
          <div class="text-center">
            <img class="login-logo" src="<?php echo e(asset('assets/img/' . $websiteInfo->logo)); ?>" alt="logo">
          </div>
        <?php endif; ?>

        <div class="auth-header text-center">
          <h2><?php echo e(__('Admin Login')); ?></h2>
          <p><?php echo e(__('Enter your credentials to manage your platform')); ?></p>
        </div>

        <?php if(session()->has('alert')): ?>
          <div class="alert alert-danger fade show" role="alert">
            <?php echo e(session('alert')); ?>

          </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.login_submit')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="form_group">
            <label><?php echo e(__('Username')); ?></label>
            <div class="input-with-icon">
              <input type="text" name="username" class="form_control" placeholder="<?php echo e(__('Enter Username')); ?>" required>
              <i class="fal fa-user"></i>
            </div>
            <?php if($errors->has('username')): ?>
              <p class="text-danger mt-1 small"><?php echo e($errors->first('username')); ?></p>
            <?php endif; ?>
          </div>

          <div class="form_group">
            <label><?php echo e(__('Password')); ?></label>
            <div class="input-with-icon">
              <input type="password" name="password" class="form_control" placeholder="<?php echo e(__('Enter Password')); ?>" required>
              <i class="fal fa-lock"></i>
            </div>
            <?php if($errors->has('password')): ?>
              <p class="text-danger mt-1 small"><?php echo e($errors->first('password')); ?></p>
            <?php endif; ?>
          </div>

          <button type="submit" class="btn-login">
            <span><?php echo e(__('Login Now')); ?></span>
            <i class="fal fa-sign-in-alt"></i>
          </button>
        </form>

        <a class="forget-link" href="<?php echo e(route('admin.forget_password')); ?>">
          <?php echo e(__('Forget Password or Username?')); ?>

        </a>
      </div>
    </div>

    
    <script src="<?php echo e(asset('assets/js/jquery-3.4.1.min.js')); ?>"></script>
    
    <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
    
    <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
  </body>
</html>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/login.blade.php ENDPATH**/ ?>