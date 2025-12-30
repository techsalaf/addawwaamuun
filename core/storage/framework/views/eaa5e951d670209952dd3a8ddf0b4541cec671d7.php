<?php if($footerSecStatus == 1): ?>
  <footer class="footer-area">
    <div class="container">
      <div class="row pb-5">
        <div class="col-lg-4 col-md-5">
          <div class="footer-item about-footer-item mt-30">
            <?php if(!is_null($basicInfo->footer_logo)): ?>
              <div class="footer-title">
                <img data-src="<?php echo e(asset('assets/img/' . $basicInfo->footer_logo)); ?>" class="lazy" alt="website logo">
              </div>
            <?php endif; ?>

            <?php if(!is_null($footerInfo)): ?>
              <div class="about-content">
                <p><?php echo e($footerInfo->about_company); ?></p>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-lg-4 col-md-7">
          <div class="footer-item mt-30">
            <div class="footer-title item-2">
              <i class="fal fa-link"></i>
              <h4 class="title"><?php echo e(__('Useful Links')); ?></h4>
            </div>

            <div class="footer-list-area">
              <?php if(count($quickLinkInfos) == 0): ?>
                <h6 class="text-light"><?php echo e(__('No Link Found') . '!'); ?></h6>
              <?php else: ?>
                <div class="footer-list d-block d-sm-flex">
                  <ul>
                    <?php $__currentLoopData = $quickLinkInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quickLinkInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><a href="<?php echo e($quickLinkInfo->url); ?>"><i class="fal fa-angle-right"></i> <?php echo e($quickLinkInfo->title); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <?php if($basicInfo->theme_version == 1): ?>
            <?php if ($__env->exists('frontend.partials.footer.latest-blogs')) echo $__env->make('frontend.partials.footer.latest-blogs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php elseif($basicInfo->theme_version == 3): ?>
            <?php if ($__env->exists('frontend.partials.footer.contact-info')) echo $__env->make('frontend.partials.footer.contact-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
        </div>
      </div>

      <div class="row border-top text-center pt-5">
        <div class="col">
          <p class="text-light">
            <?php echo !empty($footerInfo->copyright_text) ? $footerInfo->copyright_text : ''; ?>

          </p>
        </div>
      </div>
    </div>
  </footer>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/partials/footer/footer.blade.php ENDPATH**/ ?>