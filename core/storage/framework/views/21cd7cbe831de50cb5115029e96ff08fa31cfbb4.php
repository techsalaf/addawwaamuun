

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Online Gateways')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Payment Gateways')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Online Gateways')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_paypal_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Paypal')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Paypal Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="paypal_status" value="1" class="selectgroup-input" <?php echo e($paypal->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="paypal_status" value="0" class="selectgroup-input" <?php echo e($paypal->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('paypal_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paypal_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $paypalInfo = json_decode($paypal->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Paypal Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="paypal_sandbox_status" value="1" class="selectgroup-input" <?php echo e($paypalInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="paypal_sandbox_status" value="0" class="selectgroup-input" <?php echo e($paypalInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('paypal_sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paypal_sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Paypal Client ID')); ?></label>
                  <input type="text" class="form-control" name="paypal_client_id" value="<?php echo e($paypalInfo['client_id']); ?>">
                  <?php if($errors->has('paypal_client_id')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paypal_client_id')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Paypal Client Secret')); ?></label>
                  <input type="text" class="form-control" name="paypal_client_secret" value="<?php echo e($paypalInfo['client_secret']); ?>">
                  <?php if($errors->has('paypal_client_secret')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paypal_client_secret')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_instamojo_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Instamojo')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Instamojo Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="instamojo_status" value="1" class="selectgroup-input" <?php echo e($instamojo->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="instamojo_status" value="0" class="selectgroup-input" <?php echo e($instamojo->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('instamojo_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('instamojo_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $instamojoInfo = json_decode($instamojo->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Instamojo Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="instamojo_sandbox_status" value="1" class="selectgroup-input" <?php echo e($instamojoInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="instamojo_sandbox_status" value="0" class="selectgroup-input" <?php echo e($instamojoInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('instamojo_sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('instamojo_sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Instamojo API Key')); ?></label>
                  <input type="text" class="form-control" name="instamojo_key" value="<?php echo e($instamojoInfo['key']); ?>">
                  <?php if($errors->has('instamojo_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('instamojo_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Instamojo Auth Token')); ?></label>
                  <input type="text" class="form-control" name="instamojo_token" value="<?php echo e($instamojoInfo['token']); ?>">
                  <?php if($errors->has('instamojo_token')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('instamojo_token')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_paystack_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Paystack')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Paystack Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="paystack_status" value="1" class="selectgroup-input" <?php echo e($paystack->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="paystack_status" value="0" class="selectgroup-input" <?php echo e($paystack->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('paystack_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paystack_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $paystackInfo = json_decode($paystack->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Paystack Secret Key')); ?></label>
                  <input type="text" class="form-control" name="paystack_key" value="<?php echo e($paystackInfo['key']); ?>">
                  <?php if($errors->has('paystack_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paystack_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_flutterwave_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Flutterwave')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Flutterwave Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="flutterwave_status" value="1" class="selectgroup-input" <?php echo e($flutterwave->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="flutterwave_status" value="0" class="selectgroup-input" <?php echo e($flutterwave->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('flutterwave_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('flutterwave_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $flutterwaveInfo = json_decode($flutterwave->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Flutterwave Public Key')); ?></label>
                  <input type="text" class="form-control" name="flutterwave_public_key" value="<?php echo e($flutterwaveInfo['public_key']); ?>">
                  <?php if($errors->has('flutterwave_public_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('flutterwave_public_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Flutterwave Secret Key')); ?></label>
                  <input type="text" class="form-control" name="flutterwave_secret_key" value="<?php echo e($flutterwaveInfo['secret_key']); ?>">
                  <?php if($errors->has('flutterwave_secret_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('flutterwave_secret_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_razorpay_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Razorpay')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Razorpay Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="razorpay_status" value="1" class="selectgroup-input" <?php echo e($razorpay->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="razorpay_status" value="0" class="selectgroup-input" <?php echo e($razorpay->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('razorpay_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('razorpay_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $razorpayInfo = json_decode($razorpay->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Razorpay Key')); ?></label>
                  <input type="text" class="form-control" name="razorpay_key" value="<?php echo e($razorpayInfo['key']); ?>">
                  <?php if($errors->has('razorpay_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('razorpay_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Razorpay Secret')); ?></label>
                  <input type="text" class="form-control" name="razorpay_secret" value="<?php echo e($razorpayInfo['secret']); ?>">
                  <?php if($errors->has('razorpay_secret')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('razorpay_secret')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_mercadopago_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('MercadoPago')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="form-group">
              <label><?php echo e(__('MercadoPago Status')); ?></label>
              <div class="selectgroup w-100">
                <label class="selectgroup-item">
                  <input type="radio" name="mercadopago_status" value="1" class="selectgroup-input" <?php echo e($mercadopago->status == 1 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="mercadopago_status" value="0" class="selectgroup-input" <?php echo e($mercadopago->status == 0 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                </label>
              </div>
              <?php if($errors->has('mercadopago_status')): ?>
                <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('mercadopago_status')); ?></p>
              <?php endif; ?>
            </div>

            <?php $mercadopagoInfo = json_decode($mercadopago->information, true); ?>

            <div class="form-group">
              <label><?php echo e(__('MercadoPago Test Mode')); ?></label>
              <div class="selectgroup w-100">
                <label class="selectgroup-item">
                  <input type="radio" name="mercadopago_sandbox_status" value="1" class="selectgroup-input" <?php echo e($mercadopagoInfo["sandbox_status"] == 1 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="mercadopago_sandbox_status" value="0" class="selectgroup-input" <?php echo e($mercadopagoInfo["sandbox_status"] == 0 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                </label>
              </div>
              <?php if($errors->has('mercadopago_sandbox_status')): ?>
                <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('mercadopago_sandbox_status')); ?></p>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label><?php echo e(__('MercadoPago Token')); ?></label>
              <input type="text" class="form-control" name="mercadopago_token" value="<?php echo e($mercadopagoInfo['token']); ?>">
              <?php if($errors->has('mercadopago_token')): ?>
                <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('mercadopago_token')); ?></p>
              <?php endif; ?>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_mollie_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Mollie')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Mollie Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="mollie_status" value="1" class="selectgroup-input" <?php echo e($mollie->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="mollie_status" value="0" class="selectgroup-input" <?php echo e($mollie->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('mollie_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('mollie_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $mollieInfo = json_decode($mollie->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Mollie API Key')); ?></label>
                  <input type="text" class="form-control" name="mollie_key" value="<?php echo e($mollieInfo['key']); ?>">
                  <?php if($errors->has('mollie_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('mollie_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_stripe_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Stripe')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Stripe Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="stripe_status" value="1" class="selectgroup-input" <?php echo e($stripe->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="stripe_status" value="0" class="selectgroup-input" <?php echo e($stripe->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('stripe_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('stripe_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $stripeInfo = json_decode($stripe->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Stripe Key')); ?></label>
                  <input type="text" class="form-control" name="stripe_key" value="<?php echo e($stripeInfo['key']); ?>">
                  <?php if($errors->has('stripe_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('stripe_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Stripe Secret')); ?></label>
                  <input type="text" class="form-control" name="stripe_secret" value="<?php echo e($stripeInfo['secret']); ?>">
                  <?php if($errors->has('stripe_secret')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('stripe_secret')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_paytm_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Paytm')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Paytm Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="paytm_status" value="1" class="selectgroup-input" <?php echo e($paytm->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="paytm_status" value="0" class="selectgroup-input" <?php echo e($paytm->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('paytm_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $paytmInfo = json_decode($paytm->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Paytm Environment')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="paytm_environment" value="local" class="selectgroup-input" <?php echo e($paytmInfo['environment'] == 'local' ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Local')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="paytm_environment" value="production" class="selectgroup-input" <?php echo e($paytmInfo['environment'] == 'production' ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Production')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('paytm_environment')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_environment')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Paytm Merchant Key')); ?></label>
                  <input type="text" class="form-control" name="paytm_merchant_key" value="<?php echo e($paytmInfo['merchant_key']); ?>">
                  <?php if($errors->has('paytm_merchant_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_merchant_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Paytm Merchant MID')); ?></label>
                  <input type="text" class="form-control" name="paytm_merchant_mid" value="<?php echo e($paytmInfo['merchant_mid']); ?>">
                  <?php if($errors->has('paytm_merchant_mid')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_merchant_mid')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Paytm Merchant Website')); ?></label>
                  <input type="text" class="form-control" name="paytm_merchant_website" value="<?php echo e($paytmInfo['merchant_website']); ?>">
                  <?php if($errors->has('paytm_merchant_website')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_merchant_website')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Industry Type')); ?></label>
                  <input type="text" class="form-control" name="paytm_industry_type" value="<?php echo e($paytmInfo['industry_type']); ?>">
                  <?php if($errors->has('paytm_industry_type')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_industry_type')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/backend/payment-gateways/online-gateways.blade.php ENDPATH**/ ?>