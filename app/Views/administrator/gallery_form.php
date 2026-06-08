<?php
$title_val = old('title', $photo['title']       ?? '');
$desc_val  = old('description', $photo['description'] ?? '');
$photo_id  = $photo['id']    ?? 0;
$existing  = $photo['image'] ?? '';
?>

<!-- Page Header -->
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-[24px] font-bold text-primary" style="font-family:'Hanken Grotesk',sans-serif;">
            <?= $is_edit ? 'Edit Photo' : 'Upload Photo' ?>
        </h1>
        <p class="text-xs text-on-surface-variant mt-1" style="font-family:'JetBrains Mono',monospace;">Fill in the details below</p>
    </div>
    <a href="<?= base_url('administrator/gallery') ?>"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-outline-variant/40 text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors text-sm">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Back to Gallery
    </a>
</div>

<!-- Validation Errors -->
<?php if (!empty($errors)): ?>
<div class="flex flex-col gap-1 p-4 rounded-xl bg-error-container/20 border border-error/20 text-error text-sm">
    <?php foreach ($errors as $err): ?>
    <div class="flex items-center gap-2">
        <span class="material-symbols-outlined text-[16px] flex-shrink-0">error</span>
        <span><?= esc($err) ?></span>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- Form -->
<div class="bg-surface-container rounded-xl border border-outline-variant/10 p-6">
    <form method="POST" action="<?= base_url('administrator/gallery/save') ?>" enctype="multipart/form-data">
        <input type="hidden" name="id"             value="<?= $photo_id ?>">
        <input type="hidden" name="existing_image" value="<?= esc($existing) ?>">

        <div class="mb-5">
            <label class="block text-xs text-on-surface-variant uppercase tracking-widest mb-2" style="font-family:'JetBrains Mono',monospace;">Title</label>
            <input type="text" name="title"
                   class="w-full rounded-lg px-4 py-3 text-sm border"
                   value="<?= esc($title_val) ?>" required>
        </div>

        <div class="mb-5">
            <label class="block text-xs text-on-surface-variant uppercase tracking-widest mb-2" style="font-family:'JetBrains Mono',monospace;">
                <?= $is_edit ? 'Replace Photo (leave empty to keep current)' : 'Photo File' ?>
            </label>

            <?php if ($is_edit && !empty($existing)): ?>
            <div class="mb-3 flex items-center gap-4 p-3 rounded-lg bg-surface-container-high border border-outline-variant/20">
                <img src="<?= base_url('assets/images/' . esc($existing)) ?>"
                     class="w-16 h-16 object-cover rounded-lg" alt="Current photo">
                <div>
                    <p class="text-xs text-on-surface-variant">Current photo</p>
                    <p class="text-xs text-primary-fixed-dim mt-0.5" style="font-family:'JetBrains Mono',monospace;"><?= esc($existing) ?></p>
                </div>
            </div>
            <?php endif; ?>

            <label class="flex flex-col items-center justify-center w-full h-32 rounded-lg border-2 border-dashed border-outline-variant/40 hover:border-primary-fixed-dim/50 cursor-pointer transition-colors bg-surface-container-low">
                <span class="material-symbols-outlined text-[32px] text-on-surface-variant mb-1">cloud_upload</span>
                <span class="text-xs text-on-surface-variant">Click to upload — JPG, PNG, WEBP, GIF · max 2 MB</span>
                <input type="file" name="image_file" id="imageInput"
                       accept="image/jpeg,image/png,image/webp,image/gif"
                       class="hidden"
                       <?= !$is_edit ? 'required' : '' ?>>
            </label>

            <div id="previewBox" class="mt-3 hidden flex items-center gap-4 p-3 rounded-lg bg-surface-container-high border border-outline-variant/20">
                <img id="previewImg" src="" class="w-16 h-16 object-cover rounded-lg" alt="Preview">
                <p id="previewName" class="text-xs text-on-surface-variant" style="font-family:'JetBrains Mono',monospace;"></p>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-xs text-on-surface-variant uppercase tracking-widest mb-2" style="font-family:'JetBrains Mono',monospace;">Description</label>
            <textarea name="description" rows="3"
                      class="w-full rounded-lg px-4 py-3 text-sm border resize-y"><?= esc($desc_val) ?></textarea>
        </div>

        <button type="submit"
                class="w-full py-3 rounded-lg bg-primary-fixed-dim/10 border border-primary-fixed-dim/30 text-primary-fixed-dim hover:bg-primary-fixed-dim/20 transition-colors font-semibold text-sm">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">cloud_upload</span>
            <?= $is_edit ? 'Save Changes' : 'Upload & Save Photo' ?>
        </button>
    </form>
</div>

