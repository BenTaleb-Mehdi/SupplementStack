<?php $__env->startSection('content'); ?>
<div class="p-4 lg:p-6 xl:p-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl xl:text-3xl font-bold text-gray-900 mb-2">Message Details</h1>
                <p class="text-gray-600">View and reply to customer message</p>
            </div>
            <a href="<?php echo e(route('admin.messages.index')); ?>" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Messages
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Message Details -->
        <div class="lg:col-span-2">
            <!-- Message Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <!-- Message Header -->
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-sm font-medium text-gray-700">
                                    <?php echo e(substr($message->name, 0, 1)); ?>

                                </span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900"><?php echo e($message->name); ?></h3>
                                <p class="text-sm text-gray-600"><?php echo e($message->email); ?></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php echo e($message->status_color); ?>">
                                <?php echo e(ucfirst($message->status)); ?>

                            </span>
                            <p class="text-sm text-gray-500 mt-1">
                                <?php echo e($message->created_at->format('M d, Y \a\t g:i A')); ?>

                            </p>
                        </div>
                    </div>
                </div>

                <!-- Original Message -->
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Customer Message:</h4>
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <p class="text-gray-700 whitespace-pre-wrap"><?php echo e($message->message); ?></p>
                    </div>

                    <!-- Admin Reply -->
                    <?php if($message->reply): ?>
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Your Reply:</h4>
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg mb-6">
                            <p class="text-blue-700 whitespace-pre-wrap"><?php echo e($message->reply); ?></p>
                            <p class="text-xs text-blue-600 mt-2">
                                Replied on <?php echo e($message->updated_at->format('F d, Y \a\t g:i A')); ?>

                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Reply Form -->
            <?php if(!$message->reply): ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Send Reply</h3>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="<?php echo e(route('admin.messages.reply', $message)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-4">
                                <label for="reply" class="block text-sm font-medium text-gray-700 mb-2">
                                    Your Reply
                                </label>
                                <textarea id="reply" 
                                          name="reply" 
                                          rows="6" 
                                          required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['reply'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                          placeholder="Type your reply here..."><?php echo e(old('reply')); ?></textarea>
                                <?php $__errorArgs = ['reply'];
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
                            
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-500">
                                    This reply will be sent to <?php echo e($message->email); ?>

                                </p>
                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Send Reply
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Message Info -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Message Information</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($message->status_color); ?>">
                                <?php echo e(ucfirst($message->status)); ?>

                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Received</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?php echo e($message->created_at->format('F d, Y')); ?></dd>
                        <dd class="text-xs text-gray-500"><?php echo e($message->created_at->format('g:i A')); ?></dd>
                    </div>
                    <?php if($message->reply): ?>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Replied</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($message->updated_at->format('F d, Y')); ?></dd>
                            <dd class="text-xs text-gray-500"><?php echo e($message->updated_at->format('g:i A')); ?></dd>
                        </div>
                    <?php endif; ?>
                    <?php if($message->user): ?>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">User Account</dt>
                            <dd class="mt-1 text-sm text-gray-900">Registered User</dd>
                        </div>
                    <?php else: ?>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">User Account</dt>
                            <dd class="mt-1 text-sm text-gray-900">Guest</dd>
                        </div>
                    <?php endif; ?>
                </dl>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                <div class="space-y-3">
                    <?php if($message->reply): ?>
                        <div class="flex items-center text-sm text-green-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Reply sent successfully
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="<?php echo e(route('admin.messages.delete', $message)); ?>" 
                          onsubmit="return confirm('Are you sure you want to delete this message? This action cannot be undone.')" 
                          class="w-full">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\CascadeProjects\Market-Store - v2\mini-market\resources\views/admin/messages/show.blade.php ENDPATH**/ ?>