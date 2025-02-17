
<?php $__env->startSection('content'); ?>

<div class="row row-sm">
    <div class="col-md-4 col-xl-4 col-xs-12 col-sm-4">
        <div class="card border custom-card">
            <div class="card-header custom-card-header">
                <h5 class="main-content-label mb-0"><?php echo e(trans('cruds.create')); ?>

                    <?php echo e(trans('cruds.section')); ?></h5>
                <div class="card-options">
                    <a href="javascript:;" class="card-options-collapse py-0" data-bs-toggle="card-collapse"><i
                            class="fe fe-chevron-up"></i></a>
                    <a href="javascript:;" class="card-options-fullscreen py-0" data-bs-toggle="card-fullscreen"><i
                            class="fe fe-maximize"></i></a>
                    <a href="javascript:;" class="card-options-remove py-0" data-bs-toggle="card-remove"><i
                            class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.section.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <p class="mg-b-10 tx-semibold"><?php echo e(__('cruds.section_code')); ?> (<span
                                class="required">*</span>)
                        </p>
                        <input type="text"
                            class="form-control unique_code <?php echo e($errors->has('section_code') ? 'is-invalid' : ''); ?>"
                            name="section_code" id="section_code"
                            placeholder="<?php echo e(__('cruds.section_code')); ?>" data-model="Section" data-prefix="SE" data-update_id="0"  required>
                        <?php if($errors->has('section_code')): ?>
                        <em class="invalid-feedback">
                            <?php echo e($errors->first('section_code')); ?>

                        </em>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10 tx-semibold"><?php echo e(__('cruds.section_name')); ?> (<span
                                class="required">*</span>)
                        </p>
                        <input type="text"
                            class="form-control  <?php echo e($errors->has('section_name') ? 'is-invalid' : ''); ?>"
                            name="section_name" id="section_name"
                            placeholder="<?php echo e(__('cruds.section_name')); ?>" required>
                        <?php if($errors->has('section_name')): ?>
                        <em class="invalid-feedback">
                            <?php echo e($errors->first('section_name')); ?>

                        </em>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10 tx-semibold"><?php echo e(__('cruds.branch_name')); ?> (<span
                                class="required">*</span>)
                        </p>
                        <select id="branch_id" name="branch_id" class="form-control select2" required>
                            <?=options('branches', array(), array(), 'id', 'short_name', 'id', 'asc', trans('cruds.select'), 0)?>
                        </select>
                        <?php if($errors->has('branch_id')): ?>
                        <em class="invalid-feedback">
                            <?php echo e($errors->first('branch_id')); ?>

                        </em>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10 tx-semibold"><?php echo e(__('cruds.section_address')); ?> (<span
                                class="required">*</span>)
                        </p>
                        <input type="text"
                            class="form-control  <?php echo e($errors->has('section_address') ? 'is-invalid' : ''); ?>"
                            name="section_address" id="section_address"
                            placeholder="<?php echo e(__('cruds.section_address')); ?>" required>
                        <?php if($errors->has('section_address')): ?>
                        <em class="invalid-feedback">
                            <?php echo e($errors->first('section_address')); ?>

                        </em>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10 tx-semibold"><?php echo e(__('cruds.contact_person')); ?> )
                        </p>
                        <input type="text"
                            class="form-control  <?php echo e($errors->has('contact_person') ? 'is-invalid' : ''); ?>"
                            name="contact_person" id="contact_person"
                            placeholder="<?php echo e(__('cruds.contact_person')); ?>">
                        <?php if($errors->has('contact_person')): ?>
                        <em class="invalid-feedback">
                            <?php echo e($errors->first('contact_person')); ?>

                        </em>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10 tx-semibold"><?php echo e(__('cruds.contact_no')); ?> (<span
                                class="required">*</span>)
                        </p>
                        <input type="text"
                            class="form-control  <?php echo e($errors->has('contact_no') ? 'is-invalid' : ''); ?>"
                            name="contact_no" id="contact_no"
                            placeholder="<?php echo e(__('cruds.contact_no')); ?>" required>
                        <?php if($errors->has('contact_no')): ?>
                        <em class="invalid-feedback">
                            <?php echo e($errors->first('contact_no')); ?>

                        </em>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10 tx-semibold"><?php echo e(__('cruds.email_address')); ?>

                        </p>
                        <input type="text"
                            class="form-control  <?php echo e($errors->has('email_address') ? 'is-invalid' : ''); ?>"
                            name="email_address" id="email_address"
                            placeholder="<?php echo e(__('cruds.email_address')); ?>">
                        <?php if($errors->has('email_address')): ?>
                        <em class="invalid-feedback">
                            <?php echo e($errors->first('email_address')); ?>

                        </em>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="update_id" id="update_id" value="0">
                        <button class="btn ripple btn-warning update" type="submit"><?php echo e(__('cruds.submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xl-8 col-xs-8 col-sm-8">
        <div class="card border custom-card">
            <div class="card-header custom-card-header">
                <h5 class="main-content-label mb-0"><?php echo e(trans('cruds.section')); ?>

                    <?php echo e(trans('cruds.list')); ?></h5>
                <div class="card-options">
                    <a href="javascript:;" class="card-options-collapse py-0" data-bs-toggle="card-collapse"><i
                            class="fe fe-chevron-up"></i></a>
                    <a href="javascript:;" class="card-options-fullscreen py-0" data-bs-toggle="card-fullscreen"><i
                            class="fe fe-maximize"></i></a>
                    <a href="javascript:;" class="card-options-remove py-0" data-bs-toggle="card-remove"><i
                            class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-Income">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th><?php echo e(trans('cruds.actions')); ?></th>
                                <th><?php echo e(trans('cruds.section_code')); ?></th>
                                <th><?php echo e(trans('cruds.section_name')); ?></th>
                                <th><?php echo e(trans('cruds.branch_name')); ?></th>
                                <th><?php echo e(trans('cruds.section_address')); ?></th>
                                <th><?php echo e(trans('cruds.contact_person')); ?></th>
                                <th><?php echo e(trans('cruds.contact_no')); ?></th>
                                <th><?php echo e(trans('cruds.email_address')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-entry-id="<?php echo e($section->id); ?>">
                                <td>

                                </td>
                                <td>
                                    <?php if(show()): ?>
                                    <a class="btn btn-xs btn-primary"
                                        href="<?php echo e(route('admin.section.show', $section->id)); ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <?php endif; ?>

                                    <?php if(edit()): ?>
                                    <a class="btn btn-xs btn-info editAction" href="javascript:void(0)"
                                        data-table="Section" data-column="id" data-value="<?php echo e($section->id); ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <?php endif; ?>

                                     <?php if(delete()): ?>
                                    <form action="<?php echo e(route('admin.section.destroy', $section->id)); ?>" method="POST"
                                        onsubmit="return confirm('<?php echo e(trans('cruds.areYouSure')); ?>');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="fas fa-trash"></i></button>
                                    </form>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($section->section_code ?? ''); ?></td>
                                <td><?php echo e($section->section_name ?? ''); ?></td>
                                <td><?php echo e(isset($section->branch)?$section->branch->short_name : ''); ?></td>
                                <td><?php echo e($section->section_address ?? ''); ?></td>
                                <td><?php echo e($section->contact_person ?? ''); ?></td>
                                <td><?php echo e($section->contact_no ?? ''); ?></td>
                                <td><?php echo e($section->email_address ?? ''); ?></td>

                                
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
<script>
/* $(function() {
    let route = "<?php echo e(route('admin.general_settings.section.massDestroy')); ?>";
    let hasPermission = 0;
    <?php if (delete()) {?>
    hasPermission = 1;
    <?php }?>
    deleteSelected(route, hasPermission);
}) */

$(document).on("click", ".editAction", function() {
    let response = editAction(this);
    $("#update_id").val(response.id);
    $("#section_code").attr("data-update_id",response.id);
    $("#section_code").val(response.section_code);
    $("#section_name").val(response.section_name);
    $("#branch_id").val(response.branch_id).trigger('change');
    $("#section_address").val(response.section_address);
    $("#contact_person").val(response.contact_person);
    $("#contact_no").val(response.contact_no);
    $("#email_address").val(response.email_address);
    changeSubmitButtonCaption();
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nayem/Documents/projects/store_management/resources/views/admin/section/index.blade.php ENDPATH**/ ?>