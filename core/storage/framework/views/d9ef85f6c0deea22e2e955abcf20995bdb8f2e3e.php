<?php if($footerSecStatus == 1): ?>
  <footer class="footer-area footer-area-2">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="footer-item mt-30">
            <div class="footer-content">
              <?php if(!empty($newsletterTitle)): ?>
                <h3 class="title"><?php echo e($newsletterTitle); ?></h3>
              <?php endif; ?>

              <form class="subscriptionForm" action="<?php echo e(route('store_subscriber')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="input-box">
                  <input type="email" placeholder="<?php echo e(__('Enter Your Email Address')); ?>" name="email_id">
                  <i class="fal fa-envelope"></i>
                </div>
                <button type="submit"><?php echo e(__('Subscribe')); ?></button>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="footer-item mt-30">
            <div class="footer-title">
              <i class="fal fa-link"></i>
              <h4 class="title"><?php echo e(__('Useful Links')); ?></h4>
            </div>

            <div class="footer-list-area">
              <?php if(count($quickLinkInfos) == 0): ?>
                <h6 class="text-light"><?php echo e(__('No Link Found') . '!'); ?></h6>
              <?php else: ?>
                <div class="footer-list">
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
          <?php if ($__env->exists('frontend.partials.footer.latest-blogs')) echo $__env->make('frontend.partials.footer.latest-blogs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
      </div>
    </div>

    <div class="footer-dot">
      <img data-src="<?php echo e(asset('assets/img/shapes/footer-dot.png')); ?>" class="lazy" alt="footer dot">
    </div>
  </footer>

  <div class="row text-center py-4 copyright-part-two">
    <div class="col">
      <p class="text-light">
        <?php echo !empty($footerInfo->copyright_text) ? $footerInfo->copyright_text : ''; ?>

      </p>
    </div>
  </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/partials/footer/footer-v2.blade.php ENDPATH**/ ?>