<div class="col-lg-5">
  <table class="table table-striped border">
    <thead>
      <tr>
        <th scope="col"><?php echo e(__('BB Code')); ?></th>
        <th scope="col"><?php echo e(__('Meaning')); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php if($templateInfo->mail_type == 'verify_email'): ?>
        <tr>
          <td>{username}</td>
          <td scope="row"><?php echo e(__('Username of User')); ?></td>
        </tr>
      <?php endif; ?>

      <?php if($templateInfo->mail_type == 'verify_email'): ?>
        <tr>
          <td>{verification_link}</td>
          <td scope="row"><?php echo e(__('Email Verification Link')); ?></td>
        </tr>
      <?php endif; ?>

      <?php if(
        $templateInfo->mail_type == 'reset_password' || 
        $templateInfo->mail_type == 'course_enrolment' || 
        $templateInfo->mail_type == 'course_enrolment_approved' ||
        $templateInfo->mail_type == 'course_enrolment_rejected'
      ): ?>
        <tr>
          <td>{customer_name}</td>
          <td scope="row"><?php echo e(__('Name of The Customer')); ?></td>
        </tr>
      <?php endif; ?>

      <?php if($templateInfo->mail_type == 'reset_password'): ?>
        <tr>
          <td>{password_reset_link}</td>
          <td scope="row"><?php echo e(__('Password Reset Link')); ?></td>
        </tr>
      <?php endif; ?>

      <?php if(
        $templateInfo->mail_type == 'course_enrolment' || 
        $templateInfo->mail_type == 'course_enrolment_approved' ||
        $templateInfo->mail_type == 'course_enrolment_rejected'
      ): ?>
        <tr>
          <td>{order_id}</td>
          <td scope="row"><?php echo e(__('Order Id of Course Enrolment')); ?></td>
        </tr>
      <?php endif; ?>

      <?php if(
        $templateInfo->mail_type == 'course_enrolment' || 
        $templateInfo->mail_type == 'course_enrolment_approved' || 
        $templateInfo->mail_type == 'course_enrolment_rejected'
      ): ?>
        <tr>
          <td>{title}</td>
          <td scope="row"><?php echo e(__('Course Title')); ?></td>
        </tr>
      <?php endif; ?>

      <tr>
        <td>{website_title}</td>
        <td scope="row"><?php echo e(__('Website Title')); ?></td>
      </tr>
    </tbody>
  </table>
</div>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/basic-settings/email/bbcode.blade.php ENDPATH**/ ?>