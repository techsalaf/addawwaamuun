<div class="header-navigation">
  <div class="container-fluid">
    <div class="site-menu d-flex align-items-center justify-content-between">
      <div class="primary-menu">
        <div class="nav-menu">
          <!-- Navbar Close Icon -->
          <div class="navbar-close">
            <div class="cross-wrap"><i class="far fa-times"></i></div>
          </div>

          <!-- Nav Menu -->
          <nav class="main-menu">
            <ul>
              
              <?php $menuDatas = json_decode($menuInfos ?? '[]'); ?>

              <?php $__currentLoopData = $menuDatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $href = get_href($menuData); ?>

                <?php if(!property_exists($menuData, 'children')): ?>
                  <li class="menu-item">
                    <a href="<?php echo e($href); ?>"><?php echo e($menuData->text); ?></a>
                  </li>
                <?php else: ?>
                  <li class="menu-item menu-item-has-children">
                    <a class="page-scroll" href="<?php echo e($href); ?>"><?php echo e($menuData->text); ?></a>
                    <ul class="sub-menu">
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
          </nav>
        </div>

        <!-- Navbar Toggler -->
        <div class="navbar-toggler">
          <span></span><span></span><span></span>
        </div>
      </div>

      <div class="navbar-item d-flex align-items-center justify-content-end">
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

        <?php if(count($socialMediaInfos) > 0): ?>
          <div class="menu-icon">
            <ul>
              <?php $__currentLoopData = $socialMediaInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialMediaInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e($socialMediaInfo->url); ?>"><i class="<?php echo e($socialMediaInfo->icon); ?>"></i></a></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/partials/header/header-nav-v1.blade.php ENDPATH**/ ?>