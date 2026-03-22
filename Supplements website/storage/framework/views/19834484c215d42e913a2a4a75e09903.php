<?php $__env->startSection('title', 'Settings - Admin Dashboard'); ?>
<?php $__env->startSection('page-title', 'Settings'); ?>
<?php $__env->startSection('page-description', 'Manage your store settings and configuration'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <?php if(session('success')): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <!-- Settings Form -->
<form id="settingsForm" action="<?php echo e(route('admin.settings.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
    <?php echo csrf_field(); ?>
        
        <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $groupSettings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Group Header -->
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 capitalize">
                        <?php echo e(str_replace('_', ' ', $group)); ?> Settings
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">
                        <?php switch($group):
                            case ('general'): ?>
                                Basic information about your store
                                <?php break; ?>
                            <?php case ('store'): ?>
                                Store operations and inventory settings
                                <?php break; ?>
                            <?php case ('payment'): ?>
                                Payment methods and financial settings
                                <?php break; ?>
                            <?php case ('notification'): ?>
                                Email and alert preferences
                                <?php break; ?>
                            <?php default: ?>
                                Configuration options for <?php echo e($group); ?>

                        <?php endswitch; ?>
                    </p>
                </div>

                <!-- Group Settings -->
                <div class="p-6 space-y-6">
                    <?php $__currentLoopData = $groupSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="space-y-3 pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                            <!-- Label and Description -->
                            <div>
                                <label for="<?php echo e($key); ?>" class="block text-sm font-semibold text-gray-700">
                                    <?php echo e($setting['label']); ?>

                                </label>
                                <?php if($setting['description']): ?>
                                    <p class="text-xs text-gray-500 mt-1"><?php echo e($setting['description']); ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Input Field -->
                            <div class="w-full">
                                <?php switch($setting['type']):
                                    case ('boolean'): ?>
                                        <div class="flex items-center">
                                            <input type="hidden" name="settings[<?php echo e($key); ?>]" value="0">
                                            <input type="checkbox" 
                                                   id="<?php echo e($key); ?>" 
                                                   name="settings[<?php echo e($key); ?>]" 
                                                   value="1"
                                                   <?php echo e($setting['value'] ? 'checked' : ''); ?>

                                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                                            <label for="<?php echo e($key); ?>" class="ml-2 block text-sm text-gray-700">
                                                Enable this option
                                            </label>
                                        </div>
                                        <?php break; ?>

                                    <?php case ('integer'): ?>
                                        <input type="number" 
                                               id="<?php echo e($key); ?>" 
                                               name="settings[<?php echo e($key); ?>]" 
                                               value="<?php echo e($setting['value']); ?>"
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['settings.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <?php break; ?>

                                    <?php case ('float'): ?>
                                        <input type="number" 
                                               id="<?php echo e($key); ?>" 
                                               name="settings[<?php echo e($key); ?>]" 
                                               value="<?php echo e($setting['value']); ?>"
                                               step="0.01"
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['settings.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <?php break; ?>

                                    <?php case ('select'): ?>
                                        <?php if($key === 'home_hero_height'): ?>
                                            <select id="<?php echo e($key); ?>" 
                                                    name="settings[<?php echo e($key); ?>]" 
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                                <option value="min-h-[50vh]" <?php echo e($setting['value'] === 'min-h-[50vh]' ? 'selected' : ''); ?>>Small (50% Screen)</option>
                                                <option value="min-h-[75vh]" <?php echo e($setting['value'] === 'min-h-[75vh]' ? 'selected' : ''); ?>>Medium (75% Screen)</option>
                                                <option value="min-h-[95vh]" <?php echo e($setting['value'] === 'min-h-[95vh]' ? 'selected' : ''); ?>>Large (95% Screen)</option>
                                                <option value="min-h-screen" <?php echo e($setting['value'] === 'min-h-screen' ? 'selected' : ''); ?>>Full Screen (100%)</option>
                                            </select>
                                        <?php else: ?>
                                            <input type="text" 
                                                   id="<?php echo e($key); ?>" 
                                                   name="settings[<?php echo e($key); ?>]" 
                                                   value="<?php echo e($setting['value']); ?>"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['settings.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <?php endif; ?>
                                        <?php break; ?>

                                    <?php case ('text'): ?>
                                        <textarea id="<?php echo e($key); ?>" 
                                                  name="settings[<?php echo e($key); ?>]" 
                                                  rows="3"
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['settings.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e($setting['value']); ?></textarea>
                                        <?php break; ?>

                                    <?php case ('string'): ?>
                                        <?php if($key === 'site_logo'): ?>
                                            <!-- Logo Upload -->
                                            <div class="space-y-4">
                                                <?php if($setting['value']): ?>
                                                    <div class="flex items-center space-x-4">
                                                        <img src="<?php echo e(asset('storage/' . $setting['value'])); ?>" 
                                                             alt="Current Logo" 
                                                             class="h-16 w-16 object-contain rounded-lg border border-gray-300">
                                                        <div>
                                                            <p class="text-sm text-gray-600">Current Logo</p>
                                                            <p class="text-xs text-gray-500">Upload a new image to replace</p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="flex items-center justify-center w-full">
                                                    <label for="logo" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                            <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                            </svg>
                                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                            <p class="text-xs text-gray-500">PNG, JPG, GIF, SVG, WEBP (MAX. 10MB)</p>
                                                        </div>
                                                        <input id="logo" name="logo" type="file" class="hidden" accept="image/*" onchange="previewLogo(this)">
                                                    </label>
                                                </div>
                                                <div id="logo-preview" class="hidden">
                                                    <img id="logo-preview-img" src="" alt="Logo Preview" class="h-16 w-16 object-contain rounded-lg border border-gray-300">
                                                    <p class="text-sm text-gray-600 mt-2">New logo preview</p>
                                                </div>
                                            </div>
                                            <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <?php elseif($key === 'home_hero_image'): ?>
                                            <!-- Home Hero Image Upload -->
<!-- Home Hero Image Upload -->
<div class="space-y-4">
    <?php if($setting['value']): ?>
        <div class="flex items-center space-x-4">
            <img src="<?php echo e(asset('storage/' . $setting['value'])); ?>" 
                 alt="Current Home Hero Image" 
                 class="h-16 w-16 object-cover rounded-lg border border-gray-300">
            <div>
                <p class="text-sm text-gray-600">Current Home Hero Image</p>
                <p class="text-xs text-gray-500">Upload a new image to replace</p>
            </div>
        </div>
    <?php endif; ?>

    <div class="flex items-center justify-center w-full">
        <label for="home_hero_image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="text-xs text-gray-500">PNG, JPG, GIF, SVG, WEBP (MAX. 10MB)</p>
            </div>
            <input id="home_hero_image" name="home_hero_image" type="file" class="hidden" accept="image/*" onchange="previewHero(this)">
        </label>
    </div>

    <div id="hero-preview" class="hidden mt-2">
        <img id="hero-preview-img" src="" alt="Hero Preview" class="h-20 w-full object-cover rounded-lg border border-gray-300">
        <p class="text-sm text-gray-600 mt-2">New hero image preview</p>
    </div>

    <!-- Save Hero Image Button -->
    <div class="flex justify-end mt-4">
        <button type="submit" name="save_hero_image" value="1" 
            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition font-semibold flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Save Hero Image
        </button>
    </div>
                                            <?php $__errorArgs = ['home_hero_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <?php elseif($key === 'about_image'): ?>
                                            <!-- About Image Upload -->
                                            <div class="space-y-4">
                                                <?php if($setting['value']): ?>
                                                    <div class="flex items-center space-x-4">
                                                        <img src="<?php echo e(asset('storage/' . $setting['value'])); ?>" 
                                                             alt="Current About Image" 
                                                             class="h-16 w-16 object-cover rounded-lg border border-gray-300">
                                                        <div>
                                                            <p class="text-sm text-gray-600">Current About Image</p>
                                                            <p class="text-xs text-gray-500">Upload a new image to replace</p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="flex items-center justify-center w-full">
                                                    <label for="about_image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                            <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                            </svg>
                                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                            <p class="text-xs text-gray-500">PNG, JPG, GIF, SVG, WEBP (MAX. 10MB)</p>
                                                        </div>
                                                        <input id="about_image" name="about_image" type="file" class="hidden" accept="image/*" onchange="previewAbout(this)">
                                                    </label>
                                                </div>

                                                <div id="about-preview" class="hidden mt-2">
                                                    <img id="about-preview-img" src="" alt="About Preview" class="h-20 w-auto object-cover rounded-lg border border-gray-300">
                                                    <p class="text-sm text-gray-600 mt-2">New about image preview</p>
                                                </div>
                                            </div>
                                            <?php $__errorArgs = ['about_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <?php elseif($key === 'home_hero_height'): ?>
                                            <select id="<?php echo e($key); ?>" 
                                                    name="settings[<?php echo e($key); ?>]" 
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                                <option value="min-h-[50vh]" <?php echo e($setting['value'] === 'min-h-[50vh]' ? 'selected' : ''); ?>>Small (50% Screen)</option>
                                                <option value="min-h-[75vh]" <?php echo e($setting['value'] === 'min-h-[75vh]' ? 'selected' : ''); ?>>Medium (75% Screen)</option>
                                                <option value="min-h-[95vh]" <?php echo e($setting['value'] === 'min-h-[95vh]' ? 'selected' : ''); ?>>Large (95% Screen)</option>
                                                <option value="min-h-screen" <?php echo e($setting['value'] === 'min-h-screen' ? 'selected' : ''); ?>>Full Screen (100%)</option>
                                            </select>
                                        <?php elseif(in_array($key, ['site_description', 'store_address', 'store_hours'])): ?>
                                            <textarea id="<?php echo e($key); ?>" 
                                                      name="settings[<?php echo e($key); ?>]" 
                                                      rows="3"
                                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['settings.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e($setting['value']); ?></textarea>
                                        <?php else: ?>
                                            <input type="text" 
                                                   id="<?php echo e($key); ?>" 
                                                   name="settings[<?php echo e($key); ?>]" 
                                                   value="<?php echo e($setting['value']); ?>"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['settings.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <?php endif; ?>
                                        <?php break; ?>

                                    <?php default: ?>
                                        <input type="text" 
                                               id="<?php echo e($key); ?>" 
                                               name="settings[<?php echo e($key); ?>]" 
                                               value="<?php echo e($setting['value']); ?>"
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['settings.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <?php endswitch; ?>

                                <?php $__errorArgs = ['settings.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <!-- Account Settings Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Account Settings
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    Update your admin account information
                </p>
            </div>

            <!-- Account Fields -->
            <div class="p-6 space-y-6">
                <!-- Email Address -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                    <div class="lg:col-span-1">
                        <label for="admin_email" class="block text-sm font-medium text-gray-700">
                            Email Address
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Your admin account email address</p>
                    </div>
                    <div class="lg:col-span-2">
                        <input type="email" 
                               id="admin_email" 
                               name="admin_email" 
                               value="<?php echo e(Auth::user()->email); ?>"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['admin_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="Enter your email address">
                        <?php $__errorArgs = ['admin_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <hr class="border-gray-200">

                <!-- Name -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                    <div class="lg:col-span-1">
                        <label for="admin_name" class="block text-sm font-medium text-gray-700">
                            Full Name
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Your display name</p>
                    </div>
                    <div class="lg:col-span-2">
                        <input type="text" 
                               id="admin_name" 
                               name="admin_name" 
                               value="<?php echo e(Auth::user()->name); ?>"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['admin_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="Enter your full name">
                        <?php $__errorArgs = ['admin_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <hr class="border-gray-200">
            </div>
        </div>


        <!-- Password Change Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Change Password
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    Update your admin account password
                </p>
            </div>

            <!-- Password Fields -->
            <div class="p-6 space-y-6">
                <!-- Current Password -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                    <div class="lg:col-span-1">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">
                            Current Password
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Enter your current password to confirm changes</p>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="relative">
                            <input type="password" 
                                   id="current_password" 
                                   name="current_password" 
                                   class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Enter current password">
                            <button type="button" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    onclick="togglePassword('current_password')">
                                <i id="current_password-eye" class="fa fa-eye text-gray-400 hover:text-gray-600 cursor-pointer"></i>
                            </button>
                        </div>
                        <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <hr class="border-gray-200">

                <!-- New Password -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                    <div class="lg:col-span-1">
                        <label for="new_password" class="block text-sm font-medium text-gray-700">
                            New Password
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Must be at least 8 characters long</p>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="relative">
                            <input type="password" 
                                   id="new_password" 
                                   name="new_password" 
                                   class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Enter new password">
                            <button type="button" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    onclick="togglePassword('new_password')">
                                <i id="new_password-eye" class="fa fa-eye text-gray-400 hover:text-gray-600 cursor-pointer"></i>
                            </button>
                        </div>
                        <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Confirm New Password -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                    <div class="lg:col-span-1">
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">
                            Confirm New Password
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Re-enter your new password</p>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="relative">
                            <input type="password" 
                                   id="new_password_confirmation" 
                                   name="new_password_confirmation" 
                                   class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['new_password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Confirm new password">
                            <button type="button" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    onclick="togglePassword('new_password_confirmation')">
                                <i id="new_password_confirmation-eye" class="fa fa-eye text-gray-400 hover:text-gray-600 cursor-pointer"></i>
                            </button>
                        </div>
                        <?php $__errorArgs = ['new_password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end space-x-4">
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 font-medium">
                Reset Changes
            </button>
            <button type="submit" 
             
                    class="bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition duration-200 font-semibold flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Save Settings
            </button>
        </div>
    </form>

    <!-- Category Management Section -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Product Categories</h3>
                    <p class="text-sm text-gray-600 mt-1">Manage product categories for your store</p>
                </div>
                <button type="button" onclick="showAddCategoryModal()" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Category
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <?php if($categories->count() > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-primary-500 transition">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900"><?php echo e($category->name); ?></h4>
                                    <p class="text-sm text-gray-500 mt-1"><?php echo e($category->slug); ?></p>
                                    <?php if($category->description): ?>
                                        <p class="text-xs text-gray-600 mt-2"><?php echo e(Str::limit($category->description, 60)); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="flex items-center space-x-2 ml-2">
                                    <button type="button" onclick='editCategory(<?php echo json_encode($category, 15, 512) ?>)' class="text-blue-600 hover:text-blue-800" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>" method="POST" class="inline" onsubmit="return confirm('Delete this category? Products using this category will not be deleted.')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    <p class="text-gray-500 mt-4">No categories yet. Add your first category to get started.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Promotional Products Section -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Promotional Products</h3>
                    <p class="text-sm text-gray-600 mt-1">Set discount percentages for products to display on homepage</p>
                </div>
                <button type="button" onclick="showAddPromoModal()" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Promotion
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <?php if($promotions->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $promotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border border-gray-200 rounded-lg p-4 flex items-center justify-between hover:border-primary-500 transition">
                            <div class="flex items-center space-x-4 flex-1">
                                <?php if($promo->product->image): ?>
                                    <img src="<?php echo e($promo->product->image_url); ?>" alt="<?php echo e($promo->product->name); ?>" class="w-16 h-16 object-cover rounded-lg">
                                <?php else: ?>
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                <?php endif; ?>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900"><?php echo e($promo->product->name); ?></h4>
                                    <div class="flex items-center space-x-4 mt-1">
                                        <span class="text-sm text-gray-500">Original: <?php echo e(\App\Models\Setting::formatPrice($promo->product->price)); ?></span>
                                        <span class="text-sm font-semibold text-green-600"><?php echo e($promo->discount_percentage); ?>% OFF</span>
                                        <span class="text-sm font-bold text-primary-600">Now: <?php echo e(\App\Models\Setting::formatPrice($promo->discounted_price)); ?></span>
                                    </div>
                                </div>
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($promo->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?>">
                                        <?php echo e($promo->is_active ? 'Active' : 'Inactive'); ?>

                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 ml-4">
                                <button type="button" onclick='editPromo(<?php echo json_encode($promo, 15, 512) ?>)' class="text-blue-600 hover:text-blue-800" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="<?php echo e(route('admin.promotions.destroy', $promo)); ?>" method="POST" class="inline" onsubmit="return confirm('Remove this promotion?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                    <p class="text-gray-500 mt-4">No promotional products yet. Add your first promotion to get started.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>


    <!-- Settings Info -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h4 class="font-medium text-blue-900">Settings Information</h4>
                <div class="mt-2 text-sm text-blue-800">
                    <ul class="list-disc list-inside space-y-1">
                        <li><strong>General Settings:</strong> Basic store information displayed to customers</li>
                        <li><strong>Store Settings:</strong> Operational settings like stock thresholds and features</li>
                        <li><strong>Payment Settings:</strong> Configure payment methods and financial options</li>
                        <li><strong>Notification Settings:</strong> Control email alerts and notifications</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Category Modal -->
<div id="categoryModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex items-center justify-between mb-4">
            <h3 id="categoryModalTitle" class="text-lg font-semibold text-gray-900">Add New Category</h3>
            <button type="button" onclick="closeCategoryModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <form id="categoryForm" method="POST" action="<?php echo e(route('admin.categories.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" id="categoryMethod" name="_method" value="POST">
            <input type="hidden" id="categoryId" name="id">
            
            <div class="space-y-4">
                <div>
                    <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Category Name *</label>
                    <input type="text" id="categoryName" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                
                <div>
                    <label for="categoryDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="categoryDescription" name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"></textarea>
                </div>
                
                <div>
                    <label for="categoryImage" class="block text-sm font-medium text-gray-700 mb-1">Category Image</label>
                    <input type="file" id="categoryImage" name="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <p class="text-xs text-gray-500 mt-1">Upload an image for this category (optional)</p>
                    <div id="imagePreview" class="mt-2 hidden">
                        <img id="previewImg" src="" alt="Preview" class="h-20 w-20 object-cover rounded-lg">
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeCategoryModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">Save Category</button>
            </div>
        </form>
    </div>
</div>

<!-- Promotional Products Modal -->
<div id="promoModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 id="promoModalTitle" class="text-lg font-semibold text-gray-900">Add Promotion</h3>
            <button type="button" onclick="closePromoModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <form id="promoForm" method="POST" action="<?php echo e(route('admin.promotions.store')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" id="promoMethod" name="_method" value="POST">
            <input type="hidden" id="promoId" name="id" value="<?php echo e(old('id')); ?>">
            
            <div class="space-y-4">
                <div id="productSelectDiv">
                    <label for="promoProduct" class="block text-sm font-medium text-gray-700 mb-2">Select Product *</label>
                    <select id="promoProduct" name="product_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="">Choose a product...</option>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($product->id); ?>" data-image="<?php echo e($product->image_url); ?>" data-price="<?php echo e($product->price); ?>" <?php echo e(old('product_id') == $product->id ? 'selected' : ''); ?>>
                                <?php echo e($product->name); ?> - <?php echo e(\App\Models\Setting::formatPrice($product->price)); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    
                    <!-- Product Preview -->
                    <div id="productPreview" class="mt-3 hidden">
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <img id="previewProductImage" src="" alt="" class="w-16 h-16 object-cover rounded-lg">
                            <div class="flex-1">
                                <p id="previewProductName" class="font-semibold text-gray-900"></p>
                                <p id="previewProductPrice" class="text-sm text-gray-600"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label for="promoDiscount" class="block text-sm font-medium text-gray-700 mb-1">Discount Percentage *</label>
                    <div class="relative">
                        <input type="number" id="promoDiscount" name="discount_percentage" value="<?php echo e(old('discount_percentage')); ?>" min="1" max="99" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 <?php $__errorArgs = ['discount_percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="e.g., 20">
                        <span class="absolute right-3 top-2 text-gray-500">%</span>
                    </div>
                    <?php $__errorArgs = ['discount_percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <p class="text-xs text-gray-500 mt-1">Enter a value between 1 and 99</p>
                </div>
                
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" id="promoActive" name="is_active" value="1" <?php echo e(old('is_active') === null ? 'checked' : (old('is_active') ? 'checked' : '')); ?> class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Active (show on homepage)</span>
                    </label>
                    <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closePromoModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">Save Promotion</button>
            </div>
        </form>
    </div>
</div>

<script>
// Max file size in bytes (10MB)
const MAX_FILE_SIZE = 10 * 1024 * 1024;

function validateFileSize(file) {
    if (file && file.size > MAX_FILE_SIZE) {
        alert('File is too large! The maximum allowed size is 10MB. Please use a smaller image or compress this one.');
        return false;
    }
    return true;
}

// Logo preview function
function previewLogo(input) {
    if (input.files && input.files[0]) {
        if (!validateFileSize(input.files[0])) {
            input.value = ''; // Clear the input
            document.getElementById('logo-preview').classList.add('hidden');
            return;
        }
        const reader = new FileReader();
        const preview = document.getElementById('logo-preview');
        const previewImg = document.getElementById('logo-preview-img');
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Hero preview function
function previewHero(input) {
    if (input.files && input.files[0]) {
        if (!validateFileSize(input.files[0])) {
            input.value = ''; // Clear the input
            document.getElementById('hero-preview').classList.add('hidden');
            return;
        }
        const reader = new FileReader();
        const preview = document.getElementById('hero-preview');
        const previewImg = document.getElementById('hero-preview-img');
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// About preview function
function previewAbout(input) {
    if (input.files && input.files[0]) {
        if (!validateFileSize(input.files[0])) {
            input.value = ''; // Clear the input
            document.getElementById('about-preview').classList.add('hidden');
            return;
        }
        const reader = new FileReader();
        const preview = document.getElementById('about-preview');
        const previewImg = document.getElementById('about-preview-img');
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

const settingsForm = document.getElementById('settingsForm');
if (settingsForm) {
    settingsForm.addEventListener('submit', function(e) {
        // Double check file sizes on submission
        const files = this.querySelectorAll('input[type="file"]');
        for (let i = 0; i < files.length; i++) {
            if (files[i].files && files[i].files[0]) {
                if (files[i].files[0].size > MAX_FILE_SIZE) {
                    e.preventDefault();
                    alert('Cannot submit: One or more files are larger than 10MB.');
                    return false;
                }
            }
        }

        const submitBtn = document.querySelector('#settingsForm button[type="submit"]');
        if (!submitBtn) return;
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Saving...';
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }, 3000);
    });

    // Fallback: ensure clicking the Save button submits the form
    const saveBtn = document.querySelector('#settingsForm button[type="submit"]');
    if (saveBtn) {
        saveBtn.addEventListener('click', function() {
            settingsForm.submit();
        });
    }
}

// Password strength indicator
const newPasswordInput = document.getElementById('new_password');
if (newPasswordInput) {
    newPasswordInput.addEventListener('input', function() {
        const password = this.value;
        const strengthIndicator = document.getElementById('password-strength');
        if (password.length === 0) {
            if (strengthIndicator) strengthIndicator.remove();
            return;
        }
        let strength = 0;
        let strengthText = '';
        let strengthColor = '';
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        switch (strength) {
            case 0:
            case 1:
                strengthText = 'Very Weak';
                strengthColor = 'text-red-600';
                break;
            case 2:
                strengthText = 'Weak';
                strengthColor = 'text-orange-600';
                break;
            case 3:
                strengthText = 'Fair';
                strengthColor = 'text-yellow-600';
                break;
            case 4:
                strengthText = 'Good';
                strengthColor = 'text-blue-600';
                break;
            case 5:
                strengthText = 'Strong';
                strengthColor = 'text-green-600';
                break;
        }
        let indicator = document.getElementById('password-strength');
        if (!indicator) {
            indicator = document.createElement('p');
            indicator.id = 'password-strength';
            indicator.className = 'mt-1 text-sm';
            this.parentNode.appendChild(indicator);
        }
        indicator.className = `mt-1 text-sm ${strengthColor}`;
        indicator.textContent = `Password strength: ${strengthText}`;
    });
}

// Password visibility toggle
function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById(inputId + '-eye');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.className = 'fa fa-eye-slash text-gray-400 hover:text-gray-600 cursor-pointer';
    } else {
        passwordInput.type = 'password';
        eyeIcon.className = 'fa fa-eye text-gray-400 hover:text-gray-600 cursor-pointer';
    }
}

// Category Management
function showAddCategoryModal() {
    document.getElementById('categoryModalTitle').textContent = 'Add New Category';
    document.getElementById('categoryForm').action = '<?php echo e(route("admin.categories.store")); ?>';
    document.getElementById('categoryMethod').value = 'POST';
    document.getElementById('categoryId').value = '';
    document.getElementById('categoryName').value = '';
    document.getElementById('categoryDescription').value = '';
    document.getElementById('categoryModal').classList.remove('hidden');
}

function editCategory(category) {
    document.getElementById('categoryModalTitle').textContent = 'Edit Category';
    document.getElementById('categoryForm').action = `/admin/categories/${category.id}`;
    document.getElementById('categoryMethod').value = 'PUT';
    document.getElementById('categoryId').value = category.id;
    document.getElementById('categoryName').value = category.name;
    document.getElementById('categoryDescription').value = category.description || '';
    document.getElementById('categoryModal').classList.remove('hidden');
}

function closeCategoryModal() {
    document.getElementById('categoryModal').classList.add('hidden');
}

// Promotional Products Modal Functions
function showAddPromoModal() {
    document.getElementById('promoModalTitle').textContent = 'Add Promotion';
    document.getElementById('promoForm').action = '<?php echo e(route("admin.promotions.store")); ?>';
    document.getElementById('promoMethod').value = 'POST';
    document.getElementById('promoProduct').value = '';
    document.getElementById('promoDiscount').value = '';
    document.getElementById('promoActive').checked = true;
    document.getElementById('productSelectDiv').style.display = 'block';
    document.getElementById('promoModal').classList.remove('hidden');
}

function editPromo(promo) {
    document.getElementById('promoModalTitle').textContent = 'Edit Promotion';
    document.getElementById('promoForm').action = `/admin/promotions/${promo.id}`;
    document.getElementById('promoMethod').value = 'PUT';
    document.getElementById('promoDiscount').value = promo.discount_percentage;
    document.getElementById('promoActive').checked = promo.is_active;
    document.getElementById('productSelectDiv').style.display = 'none'; // Can't change product when editing
    document.getElementById('promoModal').classList.remove('hidden');
}

function closePromoModal() {
    document.getElementById('promoModal').classList.add('hidden');
    document.getElementById('productPreview').classList.add('hidden');
}

// Product preview on selection
document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('promoProduct');
    if (productSelect) {
        productSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const preview = document.getElementById('productPreview');
            
            if (this.value) {
                const image = selectedOption.getAttribute('data-image');
                const price = selectedOption.getAttribute('data-price');
                const name = selectedOption.text.split(' - ')[0];
                
                document.getElementById('previewProductImage').src = image;
                document.getElementById('previewProductName').textContent = name;
                document.getElementById('previewProductPrice').textContent = 'Original Price: ' + selectedOption.text.split(' - ')[1];
                preview.classList.remove('hidden');
            } else {
                preview.classList.add('hidden');
            }
        });

        // Trigger change event if value is already selected (e.g. after validation error)
        if (productSelect.value) {
            productSelect.dispatchEvent(new Event('change'));
        }
    }
    
    // Auto-open promo modal if there are errors
    <?php if($errors->has('product_id') || $errors->has('discount_percentage') || $errors->has('is_active')): ?>
        const promoModal = document.getElementById('promoModal');
        if (promoModal) {
            promoModal.classList.remove('hidden');
        }
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\CascadeProjects\Market-Store - v2\mini-market\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>