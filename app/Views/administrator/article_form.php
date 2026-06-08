<?php
$title_val   = old('title',   $article['title']   ?? '');
$content_val = old('content', $article['content'] ?? '');
$art_id      = $article['id'] ?? 0;
?>

<!-- Page Header -->
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-[24px] font-bold text-primary" style="font-family:'Hanken Grotesk',sans-serif;">
            <?= $is_edit ? 'Edit Article' : 'New Article' ?>
        </h1>
        <p class="text-xs text-on-surface-variant mt-1" style="font-family:'JetBrains Mono',monospace;">Fill in the details below</p>
    </div>
    <a href="<?= base_url('administrator/articles') ?>"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-outline-variant/40 text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors text-sm">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Back to List
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
    <form method="POST" action="<?= base_url('administrator/articles/save') ?>">
        <input type="hidden" name="id" value="<?= $art_id ?>">

        <div class="mb-5">
            <label class="block text-xs text-on-surface-variant uppercase tracking-widest mb-2" style="font-family:'JetBrains Mono',monospace;">Title</label>
            <input type="text" name="title"
                   class="w-full rounded-lg px-4 py-3 text-sm border"
                   value="<?= esc($title_val) ?>" required>
        </div>

        <div class="mb-6">
            <label class="block text-xs text-on-surface-variant uppercase tracking-widest mb-2" style="font-family:'JetBrains Mono',monospace;">Content</label>
            <textarea name="content" rows="14"
                      class="w-full rounded-lg px-4 py-3 text-sm border resize-y"
                      required><?= esc($content_val) ?></textarea>
        </div>

        <button type="submit"
                class="w-full py-3 rounded-lg bg-primary-fixed-dim/10 border border-primary-fixed-dim/30 text-primary-fixed-dim hover:bg-primary-fixed-dim/20 transition-colors font-semibold text-sm">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1"><?= $is_edit ? 'save' : 'publish' ?></span>
            <?= $is_edit ? 'Save Changes' : 'Publish Article' ?>
        </button>
    </form>
</div>
