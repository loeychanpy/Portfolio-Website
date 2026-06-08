<?php if ($s = session()->getFlashdata('success')): ?>
<div class="flex items-center gap-3 p-4 rounded-xl bg-primary-fixed-dim/10 border border-primary-fixed-dim/20 text-primary-fixed-dim text-sm">
    <span class="material-symbols-outlined flex-shrink-0">check_circle</span>
    <span><?= esc($s) ?></span>
</div>
<?php endif; ?>

<?php if ($e = session()->getFlashdata('error')): ?>
<div class="flex items-center gap-3 p-4 rounded-xl bg-error-container/20 border border-error/20 text-error text-sm">
    <span class="material-symbols-outlined flex-shrink-0">error</span>
    <span><?= esc($e) ?></span>
</div>
<?php endif; ?>
