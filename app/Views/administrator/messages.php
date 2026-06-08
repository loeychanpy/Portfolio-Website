<!-- Page Header -->
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-[24px] font-bold text-primary" style="font-family:'Hanken Grotesk',sans-serif;">Messages</h1>
        <p class="text-xs text-on-surface-variant mt-1" style="font-family:'JetBrains Mono',monospace;">Incoming inquiries from your portfolio</p>
    </div>
</div>

<!-- Messages Table -->
<div class="bg-surface-container rounded-xl border border-outline-variant/10 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-high/30">
                    <th class="p-4 text-xs text-on-surface-variant uppercase tracking-widest" style="font-family:'JetBrains Mono',monospace;">Sender</th>
                    <th class="p-4 text-xs text-on-surface-variant uppercase tracking-widest" style="font-family:'JetBrains Mono',monospace;">Subject</th>
                    <th class="p-4 text-xs text-on-surface-variant uppercase tracking-widest" style="font-family:'JetBrains Mono',monospace;">Date</th>
                    <th class="p-4 text-xs text-on-surface-variant uppercase tracking-widest text-right" style="font-family:'JetBrains Mono',monospace;">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                <?php foreach ($messages_list as $row): ?>
                <tr class="hover:bg-surface-variant/20 transition-colors">
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-secondary text-xs font-bold flex-shrink-0"
                                 style="font-family:'JetBrains Mono',monospace;">
                                <?= strtoupper(substr($row['name'], 0, 2)) ?>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-primary"><?= esc($row['name']) ?></p>
                                <p class="text-xs text-on-surface-variant"><?= esc($row['email']) ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-sm text-on-surface-variant"><?= esc($row['subject']) ?></td>
                    <td class="p-4 text-xs text-on-surface-variant" style="font-family:'JetBrains Mono',monospace;">
                        <?= date('d M Y, H:i', strtotime($row['sent_at'])) ?>
                    </td>
                    <td class="p-4 text-right">
                        <a href="<?= base_url('administrator/messages/' . $row['id']) ?>"
                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary-fixed-dim/10 text-primary-fixed-dim hover:bg-primary-fixed-dim/20 transition-colors">
                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($messages_list)): ?>
                <tr>
                    <td colspan="4" class="p-8 text-center text-xs text-on-surface-variant" style="font-family:'JetBrains Mono',monospace;">No messages yet.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
