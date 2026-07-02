<?php
$_menus = [
    ['icon' => 'fa-house',         'label' => 'หน้าหลัก',       'url' => 'main_2026/dashboard', 'min_level' => 1, 'key' => 'dashboard'],
    ['icon' => 'fa-cloud', 'label' => 'test',          'url' => '#',                   'min_level' => 1, 'key' => 'test'],
    ['icon' => 'fa-chart-bar',     'label' => 'รายงาน',         'url' => '#',                   'min_level' => 2, 'key' => 'report'],
    ['icon' => 'fa-file-invoice',  'label' => 'เอกสารจัดซื้อ-จัดจ้าง', 'url' => 'procurement',        'min_level' => 1, 'key' => 'procurement'],
    ['icon' => 'fa-pen-to-square', 'label' => 'จัดการเอกสารจัดซื้อ-จัดจ้าง', 'url' => 'procurement_admin/manage', 'min_level' => 2, 'key' => 'procurement_admin'],
    ['icon' => 'fa-users',         'label' => 'จัดการผู้ใช้',   'url' => 'users/manage',        'min_level' => 2, 'key' => 'users'],
    ['icon' => 'fa-gear',          'label' => 'ตั้งค่าระบบ',    'url' => '#',                   'min_level' => 3, 'key' => 'settings'],
];
$_active = $active_menu ?? '';
?>
<aside class="w-64 bg-indigo-900 flex flex-col flex-shrink-0">

  <div class="flex flex-col items-center py-6 border-b border-indigo-700">
    <img src="<?= base_url('assets/images/66-1.png') ?>" class="h-16 w-16 rounded-full object-cover">
    <span class="mt-2 text-white font-bold text-lg tracking-wide">GLIN</span>
    <span class="text-indigo-300 text-xs mt-1">
      <?php if ($role === 'program'): ?>
        <i class="fa-solid fa-shield-halved mr-1"></i>Programmer
      <?php elseif ($role === 'admin'): ?>
        <i class="fa-solid fa-user-tie mr-1"></i>Admin
      <?php else: ?>
        <i class="fa-solid fa-user mr-1"></i>User
      <?php endif; ?>
    </span>
  </div>

  <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
    <?php foreach ($_menus as $_menu): ?>
      <?php if ($role_level < $_menu['min_level']) continue; ?>
      <a href="<?= $_menu['url'] === '#' ? '#' : base_url($_menu['url']) ?>"
         class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group
                <?= $_active === $_menu['key'] ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' ?>">
        <i class="fa-solid <?= $_menu['icon'] ?> w-5 text-center
                  <?= $_active === $_menu['key'] ? 'text-white' : 'text-indigo-400 group-hover:text-white' ?>"></i>
        <span class="text-sm font-medium"><?= $_menu['label'] ?></span>
      </a>
    <?php endforeach; ?>
  </nav>

  <div class="px-4 py-4 border-t border-indigo-700">
    <div class="flex items-center gap-3 mb-3">
      <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-bold">
        <?= mb_substr($name ?: $username, 0, 1) ?>
      </div>
      <div class="overflow-hidden">
        <p class="text-white text-sm font-medium truncate"><?= htmlspecialchars($name ?: $username) ?></p>
        <p class="text-indigo-400 text-xs truncate">@<?= htmlspecialchars($username) ?></p>
      </div>
    </div>
    <a href="<?= base_url('auth/logout') ?>"
       class="flex items-center gap-2 w-full px-3 py-2 rounded-lg text-indigo-300 hover:bg-indigo-700 hover:text-white transition-colors text-sm">
      <i class="fa-solid fa-right-from-bracket"></i>
      ออกจากระบบ
    </a>
  </div>

</aside>
