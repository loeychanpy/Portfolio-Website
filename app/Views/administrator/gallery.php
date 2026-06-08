<!-- Page Header -->
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-[24px] font-bold text-primary" style="font-family:'Hanken Grotesk',sans-serif;">Gallery</h1>
        <p class="text-xs text-on-surface-variant mt-1" style="font-family:'JetBrains Mono',monospace;">Your photo collection</p>
    </div>
    <a href="<?= base_url('administrator/gallery/new') ?>"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary-fixed-dim/10 border border-primary-fixed-dim/30 text-primary-fixed-dim hover:bg-primary-fixed-dim/20 transition-colors text-sm font-semibold">
        <span class="material-symbols-outlined text-[18px]">add_photo_alternate</span> Upload Photo
    </a>
</div>

<!-- Gallery Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($photos as $row): ?>
    <div class="card-lift bg-surface-container rounded-xl border border-outline-variant/10 overflow-hidden hover:border-primary-fixed-dim/30 transition-all group">
        <div class="relative overflow-hidden" style="height:200px;">
            <img src="<?= base_url('assets/images/' . esc($row['image'])) ?>"
                 alt="<?= esc($row['title']) ?>"
                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                 onerror="this.src='<?= base_url('assets/images/placeholder.jpg') ?>'">
        </div>
        <div class="p-4">
            <h3 class="text-sm font-semibold text-primary mb-1"><?= esc($row['title']) ?></h3>
            <p class="text-xs text-on-surface-variant line-clamp-2"><?= esc($row['description']) ?></p>
        </div>
        <div class="px-4 pb-4 flex justify-end gap-2">
            <a href="<?= base_url('administrator/gallery/edit/' . $row['id']) ?>"
               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-surface-container-high text-on-surface-variant hover:bg-surface-container-highest hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[16px]">edit</span>
            </a>
            <form method="POST" action="<?= base_url('administrator/gallery/delete/' . $row['id']) ?>" style="display:inline;">
                <button type="submit"
                        onclick="return confirm('Delete this photo and its file?')"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-error-container/20 text-error hover:bg-error-container/40 transition-colors">
                    <span class="material-symbols-outlined text-[16px]">delete</span>
                </button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if (empty($photos)): ?>
    <div class="col-span-3 flex flex-col items-center justify-center py-16 text-center">
        <span class="material-symbols-outlined text-[48px] text-on-surface-variant opacity-30 mb-3">photo_library</span>
        <p class="text-xs text-on-surface-variant" style="font-family:'JetBrains Mono',monospace;">No photos yet. Upload your first one!</p>
    </div>
    <?php endif; ?>
</div>
