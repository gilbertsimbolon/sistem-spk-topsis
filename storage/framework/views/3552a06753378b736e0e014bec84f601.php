<?php $__env->startSection('title', 'Register | SIK'); ?>

<?php
    $hideLayout = true;
?>

<?php $__env->startSection('content'); ?>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                                <span class="app-brand-text demo text-heading fw-bold mb-2">Registrasi</span>
                            </a>
                        </div>
                        <h4 class="mb-1">Mulai pengalaman Anda 🚀</h4>
                        <p class="mb-6">Mencari kost menjadi mudah!</p>

                        <form method="POST" action="<?php echo e(route('register.create')); ?>">
                            <?php echo csrf_field(); ?>

                            
                            <div class="mb-2">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name"
                                    value="<?php echo e(old('name')); ?>" placeholder="Masukkan nama lengkap anda" autofocus />
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="mb-2">
                                <label for="fakultas" class="form-label">Fakultas</label>
                                <select class="form-select <?php $__errorArgs = ['fakultas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="fakultas">
                                    <option value="fatek" <?php echo e(old('fakultas') == 'fatek' ? 'selected' : ''); ?>>Fakultas Teknik</option>
                                    <option value="feb" <?php echo e(old('fakultas') == 'feb' ? 'selected' : ''); ?>>Fakultas Ekonomi & Bisnis</option>
                                    <option value="fbs" <?php echo e(old('fakultas') == 'fbs' ? 'selected' : ''); ?>>Fakultas Bahasa & Seni</option>
                                    <option value="fish" <?php echo e(old('fakultas') == 'fish' ? 'selected' : ''); ?>>Fakultas Ilmu Sosial & Hukum</option>
                                    <option value="fikkm" <?php echo e(old('fakultas') == 'fikkm' ? 'selected' : ''); ?>>Fakultas Ilmu Keolahragaan & Kesehatan Masyarakat</option>
                                    <option value="fke" <?php echo e(old('fakultas') == 'fke' ? 'selected' : ''); ?>>Fakultas Kedokteran</option>
                                    <option value="fipp" <?php echo e(old('fakultas') == 'fipp' ? 'selected' : ''); ?>>Fakultas Ilmu Pendidikan</option>
                                </select>
                                <?php $__errorArgs = ['fakultas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email"
                                    value="<?php echo e(old('email')); ?>" placeholder="Masukkan email anda" />
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="form-password-toggle mb-2">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                        placeholder="············" />
                                    <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <button class="btn btn-primary d-grid w-100 mb-3">Daftar</button>
                        </form>

                        <p class="text-center">
                            <span>Sudah punya akun?</span>
                            <a href="<?php echo e(route('login')); ?>">
                                <span>Login</span>
                            </a>
                        </p>
                    </div>
                </div>
                </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\spk-topsis\resources\views/auth/register.blade.php ENDPATH**/ ?>