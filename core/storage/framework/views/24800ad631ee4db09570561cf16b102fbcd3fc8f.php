<footer class="footer-v4">
  <div class="footer-v4-wrapper">
    <div class="container">
      <div class="footer-v4-top">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="footer-v4-section">
              <div class="footer-v4-brand">
                <?php if(!is_null($basicInfo->footer_logo)): ?>
                  <div class="footer-v4-logo">
                    <img data-src="<?php echo e(asset('assets/img/' . $basicInfo->footer_logo)); ?>" class="lazy" alt="footer logo">
                  </div>
                <?php endif; ?>
                <?php if(!is_null($footerInfo)): ?>
                  <p class="footer-v4-desc"><?php echo e($footerInfo->about_company); ?></p>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6">
            <div class="footer-v4-section">
              <h4 class="footer-v4-title">Quick Links</h4>
              <?php if(count($quickLinkInfos) > 0): ?>
                <ul class="footer-v4-list">
                  <?php $__currentLoopData = $quickLinkInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quickLinkInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                      <a href="<?php echo e($quickLinkInfo->url); ?>">
                        <i class="fal fa-angle-right"></i> <?php echo e($quickLinkInfo->title); ?>

                      </a>
                    </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              <?php else: ?>
                <p class="text-muted">No links found</p>
              <?php endif; ?>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="footer-v4-section">
              <h4 class="footer-v4-title">Contact Info</h4>
              <ul class="footer-v4-contact">
                <?php if(!is_null($contactInfo->phone)): ?>
                  <li><i class="fal fa-phone"></i> <a href="tel:<?php echo e($contactInfo->phone); ?>"><?php echo e($contactInfo->phone); ?></a></li>
                <?php endif; ?>
                <?php if(!is_null($contactInfo->email)): ?>
                  <li><i class="fal fa-envelope"></i> <a href="mailto:<?php echo e($contactInfo->email); ?>"><?php echo e($contactInfo->email); ?></a></li>
                <?php endif; ?>
                <?php if(!is_null($contactInfo->address)): ?>
                  <li><i class="fal fa-map-marker-alt"></i> <?php echo e($contactInfo->address); ?></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="footer-v4-section">
              <h4 class="footer-v4-title">Follow Us</h4>
              <?php if(count($socialMediaInfos) > 0): ?>
                <div class="footer-v4-social">
                  <?php $__currentLoopData = $socialMediaInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialMediaInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($socialMediaInfo->url); ?>" target="_blank" rel="noopener" class="social-link-v4">
                      <i class="<?php echo e($socialMediaInfo->icon); ?>"></i>
                    </a>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <div class="footer-v4-divider"></div>

      <div class="footer-v4-bottom">
        <div class="row align-items-center">
          <div class="col-md-6">
            <p class="footer-v4-copyright">
              <?php echo !empty($footerInfo->copyright_text)
                ? $footerInfo->copyright_text
                : 'Copyright © ' . date('Y') . ' All Rights Reserved'; ?>

            </p>
          </div>
          <div class="col-md-6 text-right">
            <div class="footer-v4-bottom-links">
              <a href="#">Privacy Policy</a>
              <span class="divider">|</span>
              <a href="#">Terms of Service</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/partials/footer/footer-v4.blade.php ENDPATH**/ ?>