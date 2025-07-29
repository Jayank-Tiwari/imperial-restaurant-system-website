

<?php $__env->startSection('title', 'Menu Items - Imperial Spice'); ?>
<?php $__env->startSection('active', 'menu'); ?>

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Menu Items</h1>
        <a href="<?php echo e(route('admin.menu.create')); ?>" class="btn btn-primary">+ Add New Item</a>
    </div>

    <!-- Search -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="<?php echo e(route('admin.menu-management')); ?>" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search dishes..."
                       value="<?php echo e(request()->get('search')); ?>">
                <button type="submit" class="btn btn-outline-primary me-2">Search</button>
                <?php if(request()->has('search')): ?>
                    <a href="<?php echo e(route('admin.menu-management')); ?>" class="btn btn-outline-secondary">Clear</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Menu Items</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Price (₹)</th>
                            <th>Availability</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>#<?php echo e($item->id); ?></td>
                                <td>
                                    <?php if($item->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="Menu Image"
                                             style="width: 60px; height: 60px; object-fit: cover;" class="rounded">
                                    <?php else: ?>
                                        <span class="text-muted">No image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e(Str::limit($item->description, 50)); ?></td>
                                <td><?php echo e($item->category?->name ?? '-'); ?></td>
                                <td><?php echo e(number_format($item->price, 2)); ?></td>
                                <td>
                                    <?php if($item->availability): ?>
                                        <span class="badge bg-success">Available</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Unavailable</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($item->created_at->format('d M Y')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.menu.edit', $item->id)); ?>"
                                       class="btn btn-sm btn-outline-warning mb-1">Edit</a>
                                    <form action="<?php echo e(route('admin.menu.destroy', $item->id)); ?>" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No menu items found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="mt-4 d-flex justify-content-center">
                    <?php echo e($menuItems->appends(request()->query())->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/menu/index.blade.php ENDPATH**/ ?>