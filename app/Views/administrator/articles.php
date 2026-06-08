<!-- Page Header -->
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-[24px] font-bold text-primary" style="font-family:'Hanken Grotesk',sans-serif;">Articles</h1>
        <p class="text-xs text-on-surface-variant mt-1" style="font-family:'JetBrains Mono',monospace;">Manage your published content</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="<?= base_url('administrator/articles/export') ?>"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-outline-variant/40 text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors text-sm">
            <span class="material-symbols-outlined text-[18px]">download</span> Export XML
        </a>
        <a href="<?= base_url('administrator/articles/new') ?>"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary-fixed-dim/10 border border-primary-fixed-dim/30 text-primary-fixed-dim hover:bg-primary-fixed-dim/20 transition-colors text-sm font-semibold">
            <span class="material-symbols-outlined text-[18px]">add</span> New Article
        </a>
    </div>
</div>

<!-- Articles Table -->
<div class="bg-surface-container rounded-xl border border-outline-variant/10 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-high/30">
                    <th class="p-4 text-xs text-on-surface-variant uppercase tracking-widest" style="font-family:'JetBrains Mono',monospace;">Title</th>
                    <th class="p-4 text-xs text-on-surface-variant uppercase tracking-widest" style="font-family:'JetBrains Mono',monospace;">Date</th>
                    <th class="p-4 text-xs text-on-surface-variant uppercase tracking-widest text-right" style="font-family:'JetBrains Mono',monospace;">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                <?php foreach ($articles as $row): ?>
                <tr class="hover:bg-surface-variant/20 transition-colors">
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-primary-fixed-dim/10 flex items-center justify-center text-primary-fixed-dim flex-shrink-0">
                                <span class="material-symbols-outlined text-[16px]">article</span>
                            </div>
                            <span class="text-sm font-medium text-primary"><?= esc($row['title']) ?></span>
                        </div>
                    </td>
                    <td class="p-4 text-xs text-on-surface-variant" style="font-family:'JetBrains Mono',monospace;">
                        <?= date('d M Y', strtotime($row['created_at'])) ?>
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="<?= base_url('administrator/articles/edit/' . $row['id']) ?>"
                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-surface-container-high text-on-surface-variant hover:bg-surface-container-highest hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[16px]">edit</span>
                            </a>
                            <form method="POST" action="<?= base_url('administrator/articles/delete/' . $row['id']) ?>" style="display:inline;">
                                <button type="submit"
                                        onclick="return confirm('Delete this article?')"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-error-container/20 text-error hover:bg-error-container/40 transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($articles)): ?>
                <tr>
                    <td colspan="3" class="p-8 text-center text-xs text-on-surface-variant" style="font-family:'JetBrains Mono',monospace;">No articles yet. Create your first one!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
