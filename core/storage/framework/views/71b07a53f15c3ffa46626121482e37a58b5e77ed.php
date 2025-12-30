<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->login_page_title ?? 'Login'); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_keyword_login); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_description_login); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if($basicInfo->theme_version == 4): ?>
    <!-- ============ V4 LOGIN SECTION ============ -->
    <section class="auth-section-v4 py-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-8">
            <div class="auth-card-v4" data-animation="fade-up">
              <div class="auth-header-v4 mb-4 text-center">
                <h2 class="mb-2"><?php echo e($pageHeading->login_page_title ?? 'Welcome Back'); ?></h2>
                <p><?php echo e(__('Please enter your credentials to access your account')); ?></p>
              </div>

              <div class="auth-form-v4">
                <form action="<?php echo e(route('user.login_submit')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <div class="form_group mb-3">
                    <label class="mb-2"><?php echo e(__('Email Address')); ?></label>
                    <div class="input-with-icon">
                      <i class="fal fa-envelope"></i>
                      <input type="email" class="form_control" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('Enter your email')); ?>">
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger mt-1 small"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <div class="form_group mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <label><?php echo e(__('Password')); ?></label>
                      <a href="<?php echo e(route('user.forget_password')); ?>" class="forgot-link small"><?php echo e(__('Forgot Password?')); ?></a>
                    </div>
                    <div class="input-with-icon">
                      <i class="fal fa-lock"></i>
                      <input type="password" class="form_control" name="password" placeholder="<?php echo e(__('Enter your password')); ?>">
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger mt-1 small"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <?php if($recaptchaInfo->google_recaptcha_status == 1): ?>
                    <div class="form_group mt-4 mb-4 d-flex justify-content-center">
                      <?php echo NoCaptcha::renderJs(); ?>

                      <?php echo NoCaptcha::display(); ?>

                    </div>
                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger mt-1 small text-center"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  <?php endif; ?>

                  <div class="form_group mt-4">
                    <button type="submit" class="btn btn-primary w-100 justify-content-center">
                      <span><?php echo e(__('Login Now')); ?></span>
                      <i class="fal fa-sign-in-alt"></i>
                    </button>
                  </div>
                </form>

                <div class="auth-footer-v4 mt-4 text-center">
                  <p><?php echo e(__("Don't have an account?")); ?> <a href="<?php echo e(route('user.signup')); ?>" class="text-primary font-weight-bold"><?php echo e(__('Sign Up Free')); ?></a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <style>
      .auth-section-v4 {
        background: var(--bg-secondary);
        position: relative;
        overflow: hidden;
      }
      .auth-section-v4::before {
        content: '';
        position: absolute;
        top: -10%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(24, 102, 212, 0.05) 0%, transparent 70%);
        z-index: 0;
      }
      .auth-section-v4::after {
        content: '';
        position: absolute;
        bottom: -10%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(88, 12, 227, 0.05) 0%, transparent 70%);
        z-index: 0;
      }
      .auth-card-v4 {
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: var(--shadow-xl);
        position: relative;
        z-index: 1;
        border: 1px solid var(--border);
      }
      .auth-header-v4 h2 {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .input-with-icon {
        position: relative;
      }
      .input-with-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        transition: var(--transition);
      }
      .input-with-icon .form_control {
        padding-left: 45px;
        height: 55px;
        border-radius: 10px;
        border: 1.5px solid var(--border);
        transition: var(--transition);
      }
      .input-with-icon .form_control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(24, 102, 212, 0.1);
      }
      .input-with-icon .form_control:focus + i {
        color: var(--primary);
      }
      .forgot-link {
        color: var(--text-secondary);
        text-decoration: none;
        transition: var(--transition);
      }
      .forgot-link:hover {
        color: var(--primary);
      }
      .btn-primary {
        height: 55px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        box-shadow: 0 4px 15px rgba(24, 102, 212, 0.3);
      }
      .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(24, 102, 212, 0.4);
      }
    </style>
  <?php else: ?>
    <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageHeading->login_page_title ?? 'Login'])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $bgImg->breadcrumb, 'title' => $pageHeading->login_page_title ?? 'Login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--====== User Login Part Start ======-->
    <div class="user-area-section pt-120 pb-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="user-form">
              <form action="<?php echo e(route('user.login_submit')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form_group">
                  <label><?php echo e(__('Email Address') . '*'); ?></label>
                  <input type="email" class="form_control" name="email" value="<?php echo e(old('email')); ?>">
                  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger mb-3"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form_group">
                  <label><?php echo e(__('Password') . '*'); ?></label>
                  <input type="password" class="form_control" name="password" value="<?php echo e(old('password')); ?>">
                  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger mb-4"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <?php if($recaptchaInfo->google_recaptcha_status == 1): ?>
                  <div class="form_group mt-2 mb-4">
                    <?php echo NoCaptcha::renderJs(); ?>

                    <?php echo NoCaptcha::display(); ?>


                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-3 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endif; ?>

                <div class="form_group d-flex justify-content-between align-items-center">
                  <button type="submit" class="main-btn"><?php echo e(__('Login')); ?></button>
                  <a href="<?php echo e(route('user.forget_password')); ?>"><?php echo e(__('Lost your password') . '?'); ?></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--====== User Login Part End ======-->
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/login.blade.php ENDPATH**/ ?>