

<?php $__env->startSection('title', 'Edit Menu Item'); ?>
<?php $__env->startSection('active', 'menu'); ?>

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
    <div class="pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2">Edit Menu Item</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="<?php echo e(route('admin.menu.update', $menuItem->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Dish Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo e(old('name', $menuItem->name)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control" name="description" rows="3"><?php echo e(old('description', $menuItem->description)); ?></textarea>
                </div>

                
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $menuItem->category_id) == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (₹)</label>
                    <input type="number" step="0.01" class="form-control" name="price" value="<?php echo e(old('price', $menuItem->price)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="availability" class="form-label">Availability</label>
                    <select name="availability" class="form-select" required>
                        <option value="1" <?php echo e($menuItem->availability == 1 ? 'selected' : ''); ?>>Available</option>
                        <option value="0" <?php echo e($menuItem->availability == 0 ? 'selected' : ''); ?>>Unavailable</option>
                    </select>
                </div>

                <?php if($menuItem->image): ?>
                    <div class="mb-3">
                        <label class="form-label">Current Image</label><br>
                        <img src="<?php echo e(asset('storage/' . $menuItem->image)); ?>" alt="Menu Image" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="image" class="form-label">Change Image (Optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">JPEG, PNG, JPG, or WEBP. Max 2MB.</small>
                </div>

                <button type="submit" class="btn btn-primary">Update Item</button>
                <a href="<?php echo e(route('admin.menu-management')); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/menu/edit.blade.php ENDPATH**/ ?>