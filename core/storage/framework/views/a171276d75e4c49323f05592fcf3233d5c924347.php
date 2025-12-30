<div class="header-top">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-7 col-sm-5">
        <div class="header-logo d-flex align-items-center justify-content-center justify-content-sm-start">
          <div class="logo">
            <?php if(!is_null($websiteInfo)): ?>
              <a href="<?php echo e(route('index')); ?>">
                <img data-src="<?php echo e(asset('assets/img/' . $websiteInfo->logo)); ?>" class="lazy" alt="website logo">
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-5 col-sm-7">
        <div class="header-btns d-flex align-items-center justify-content-center justify-content-sm-end">

          <div class="menu-btns">
            <ul>
              <?php if(auth()->guard('web')->guest()): ?>
                <li><a href="<?php echo e(route('user.login')); ?>"><i class="fal fa-sign-in-alt"></i> <?php echo e(__('Login')); ?></a></li>
                <li><a href="<?php echo e(route('user.signup')); ?>"><i class="fal fa-user-plus"></i> <?php echo e(__('Signup')); ?></a></li>
              <?php endif; ?>

              <?php if(auth()->guard('web')->check()): ?>
                <?php $authUserInfo = Auth::guard('web')->user(); ?>

                <li><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fal fa-user"></i> <?php echo e($authUserInfo->username); ?></a></li>
                <li><a href="<?php echo e(route('user.logout')); ?>"><i class="fal fa-sign-out-alt"></i> <?php echo e(__('Logout')); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>

          <div class="menu-dropdown">
            <form action="<?php echo e(route('change_language')); ?>" method="GET">
              <select class="wide" name="lang_code" onchange="this.form.submit()">
                <?php $__currentLoopData = $allLanguageInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languageInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($languageInfo->code); ?>" <?php echo e($languageInfo->code == $currentLanguageInfo->code ? 'selected' : ''); ?>>
                    <?php echo e($languageInfo->name); ?>

                  </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/partials/header/header-top-v3.blade.php ENDPATH**/ ?>