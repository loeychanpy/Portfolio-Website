<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Console | Janisha Jaya</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600;700&family=Inter:wght@400;500&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/admin.css') ?>" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface":                    "#08132a",
                        "surface-dim":                "#08132a",
                        "surface-container-lowest":   "#030d25",
                        "surface-container-low":      "#101b33",
                        "surface-container":          "#151f37",
                        "surface-container-high":     "#1f2942",
                        "surface-container-highest":  "#2a344d",
                        "surface-variant":            "#2a344d",
                        "on-surface":                 "#d9e2ff",
                        "on-surface-variant":         "#bacac3",
                        "primary":                    "#ffffff",
                        "primary-fixed":              "#5ffbd6",
                        "primary-fixed-dim":          "#38debb",
                        "on-primary-fixed":           "#002019",
                        "secondary":                  "#b9c7e4",
                        "secondary-container":        "#3c4962",
                        "on-secondary-container":     "#abb9d6",
                        "secondary-fixed-dim":        "#b9c7e4",
                        "tertiary-fixed-dim":         "#b6c6ed",
                        "tertiary-container":         "#d8e2ff",
                        "error":                      "#ffb4ab",
                        "error-container":            "#93000a",
                        "on-error-container":         "#ffdad6",
                        "outline":                    "#85948e",
                        "outline-variant":            "#3c4a45",
                        "background":                 "#08132a",
                        "on-background":              "#d9e2ff",
                    }
                }
            }
        }
    </script>
</head>
<body class="overflow-hidden h-screen flex">

<!-- Sidebar -->
<aside class="hidden md:flex flex-col h-full w-64 fixed left-0 top-0 bg-surface-container border-r border-outline-variant/10 py-6 px-4 z-50">
    <div class="mb-10 px-2">
        <h1 class="text-2xl font-bold text-primary tracking-tight" style="font-family:'Hanken Grotesk',sans-serif;">Janisha Jaya</h1>
        <p class="text-xs text-on-surface-variant opacity-60 mt-1" style="font-family:'JetBrains Mono',monospace;letter-spacing:0.05em;">Portfolio Manager</p>
    </div>

    <nav class="flex-1 space-y-1">
        <?php
        $nav_items = [
            ['href' => base_url('administrator/dashboard'), 'icon' => 'dashboard',    'label' => 'Overview',  'key' => 'dashboard'],
            ['href' => base_url('administrator/articles'),  'icon' => 'article',       'label' => 'Articles',  'key' => 'articles'],
            ['href' => base_url('administrator/gallery'),   'icon' => 'photo_library', 'label' => 'Gallery',   'key' => 'gallery'],
            ['href' => base_url('administrator/messages'),  'icon' => 'mail',          'label' => 'Messages',  'key' => 'messages'],
        ];
        foreach ($nav_items as $item):
            $active = ($current_page === $item['key']);
        ?>
        <a href="<?= $item['href'] ?>"
           class="flex items-center gap-3 px-4 py-3 transition-all duration-200 active:scale-95 <?= $active
               ? 'bg-secondary-container/30 text-primary-fixed-dim border-l-4 border-primary-fixed-dim font-bold'
               : 'text-on-surface-variant border-l-4 border-transparent hover:bg-surface-variant/50 hover:text-primary' ?>">
            <span class="material-symbols-outlined"><?= $item['icon'] ?></span>
            <span><?= $item['label'] ?></span>
        </a>
        <?php endforeach; ?>
    </nav>

    <div class="border-t border-outline-variant/10 pt-4 mt-4">
        <a href="<?= base_url('administrator/logout') ?>"
           class="flex items-center gap-3 px-4 py-3 text-error border-l-4 border-transparent hover:bg-error-container/20 transition-all duration-200">
            <span class="material-symbols-outlined">logout</span>
            <span>Logout</span>
        </a>
    </div>

    <div class="mt-4 flex items-center gap-3 p-2 bg-surface-container-high rounded-xl">
        <div class="w-10 h-10 rounded-full bg-primary-fixed-dim/20 flex items-center justify-center text-primary-fixed-dim font-bold text-sm flex-shrink-0"
             style="font-family:'JetBrains Mono',monospace;">
            <?= strtoupper(substr($admin_name, 0, 2)) ?>
        </div>
        <div class="min-w-0">
            <p class="text-xs text-primary font-semibold truncate" style="font-family:'JetBrains Mono',monospace;"><?= esc($admin_name) ?></p>
            <p class="text-[10px] text-on-surface-variant">Admin Console</p>
        </div>
    </div>
</aside>

<!-- Main Content -->
<main class="flex-1 md:ml-64 flex flex-col h-screen overflow-hidden">

    <!-- Top App Bar -->
    <header class="sticky top-0 z-40 bg-surface border-b border-outline-variant/20 flex justify-between items-center px-6 py-4">
        <div class="flex items-center flex-1 max-w-xl">
            <div class="relative w-full">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                <input id="admin-search"
                       class="w-full bg-surface-container-low border border-outline-variant/30 rounded-lg py-2 pl-10 pr-4 text-sm placeholder:text-on-surface-variant/50"
                       placeholder="Search articles, messages..." type="text" autocomplete="off">
            </div>
        </div>
        <div class="flex items-center gap-3 ml-6">
            <a href="<?= base_url('home') ?>" target="_blank"
               class="text-[11px] px-3 py-1.5 rounded-lg border border-primary-fixed-dim/30 text-primary-fixed-dim hover:bg-primary-fixed-dim/10 transition-colors font-semibold"
               style="font-family:'JetBrains Mono',monospace;letter-spacing:0.05em;">
                VIEW SITE
            </a>
        </div>
    </header>

    <!-- Scrollable Content Area -->
    <div class="flex-1 overflow-y-auto custom-scrollbar p-6 space-y-6">
