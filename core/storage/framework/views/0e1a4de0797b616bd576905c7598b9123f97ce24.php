<div class="header-v4-wrapper">
  <div class="container">
    <div class="header-v4-content">
      <div class="header-v4-logo">
        <?php if(!is_null($websiteInfo)): ?>
          <a href="<?php echo e(route('index')); ?>" class="logo-link">
            <img data-src="<?php echo e(asset('assets/img/' . $websiteInfo->logo)); ?>" class="lazy" alt="website logo">
          </a>
        <?php endif; ?>
      </div>

      <nav class="header-v4-nav">
        <ul class="nav-menu-v4">
          <?php $menuDatas = json_decode($menuInfos); ?>

          <?php $__currentLoopData = $menuDatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $href = get_href($menuData); ?>

            <?php if(!property_exists($menuData, 'children')): ?>
              <li class="nav-item-v4">
                <a href="<?php echo e($href); ?>" class="nav-link-v4"><?php echo e($menuData->text); ?></a>
              </li>
            <?php else: ?>
              <li class="nav-item-v4 nav-item-dropdown-v4">
                <a href="<?php echo e($href); ?>" class="nav-link-v4">
                  <?php echo e($menuData->text); ?> <i class="fal fa-chevron-down"></i>
                </a>
                <ul class="dropdown-menu-v4">
                  <?php $childMenuDatas = $menuData->children; ?>
                  <?php $__currentLoopData = $childMenuDatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childMenuData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $child_href = get_href($childMenuData); ?>
                    <li>
                      <a href="<?php echo e($child_href); ?>"><?php echo e($childMenuData->text); ?></a>
                    </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </li>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <button class="nav-toggle-v4">
          <span></span><span></span><span></span>
        </button>
      </nav>

      <div class="header-v4-actions">
        <div class="language-selector-v4">
          <form action="<?php echo e(route('change_language')); ?>" method="GET">
            <select class="lang-select-v4" name="lang_code" onchange="this.form.submit()">
              <?php $__currentLoopData = $allLanguageInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languageInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($languageInfo->code); ?>"
                  <?php echo e($languageInfo->code == $currentLanguageInfo->code ? 'selected' : ''); ?>>
                  <?php echo e($languageInfo->name); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </form>
        </div>

        <div class="auth-buttons-v4">
          <?php if(auth()->guard('web')->guest()): ?>
            <a href="<?php echo e(route('user.login')); ?>" class="btn-auth-v4 btn-login-v4" title="Login">
              <i class="fal fa-sign-in-alt"></i>
            </a>
            <a href="<?php echo e(route('user.signup')); ?>" class="btn-auth-v4 btn-signup-v4" title="Sign Up">
              <i class="fal fa-user-plus"></i>
            </a>
          <?php endif; ?>

          <?php if(auth()->guard('web')->check()): ?>
            <?php $authUserInfo = Auth::guard('web')->user(); ?>
            <div class="user-menu-v4">
              <button class="user-button-v4"><?php echo e($authUserInfo->username); ?></button>
              <ul class="user-dropdown-v4">
                <li>
                  <a href="<?php echo e(route('user.dashboard')); ?>">
                    <i class="fal fa-user"></i> Dashboard
                  </a>
                </li>
                <li>
                  <a href="<?php echo e(route('user.logout')); ?>">
                    <i class="fal fa-sign-out-alt"></i> Logout
                  </a>
                </li>
              </ul>
            </div>
          <?php endif; ?>
        </div>

        <?php if(count($socialMediaInfos) > 0): ?>
          <div class="social-icons-v4">
            <ul>
              <?php $__currentLoopData = $socialMediaInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialMediaInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <a href="<?php echo e($socialMediaInfo->url); ?>" target="_blank">
                    <i class="<?php echo e($socialMediaInfo->icon); ?>"></i>
                  </a>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="mobile-menu-overlay-v4"></div>
</div>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/partials/header/header-nav-v4.blade.php ENDPATH**/ ?>