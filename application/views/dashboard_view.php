<!doctype html>
<html class="h-full">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>หน้าหลัก - Ci</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="icon" href="<?= base_url('assets/images/66-1.png') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="h-full bg-gray-100">
<div class="flex h-screen overflow-hidden">

  <!-- Sidebar -->
  <aside class="w-64 bg-indigo-900 flex flex-col flex-shrink-0">

    <!-- Logo -->
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

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

      <?php
      $menus = [
        ['icon' => 'fa-house',          'label' => 'หน้าหลัก',       'url' => 'main_2026/dashboard', 'min_level' => 1],
        ['icon' => 'fa-cart-shopping',  'label' => 'Order',          'url' => '#',                   'min_level' => 1],
        ['icon' => 'fa-chart-bar',      'label' => 'รายงาน',         'url' => '#',                   'min_level' => 2],
        ['icon' => 'fa-users',          'label' => 'จัดการผู้ใช้',   'url' => '#',                   'min_level' => 2],
        ['icon' => 'fa-gear',           'label' => 'ตั้งค่าระบบ',    'url' => '#',                   'min_level' => 3],
      ];
      foreach ($menus as $menu):
        if ($role_level < $menu['min_level']) continue;
      ?>
        <a href="<?= $menu['url'] === '#' ? '#' : base_url($menu['url']) ?>"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-indigo-100 hover:bg-indigo-700 hover:text-white transition-colors group">
          <i class="fa-solid <?= $menu['icon'] ?> w-5 text-center text-indigo-400 group-hover:text-white"></i>
          <span class="text-sm font-medium"><?= $menu['label'] ?></span>
        </a>
      <?php endforeach; ?>

    </nav>

    <!-- User Info + Logout -->
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

  <!-- Main Content -->
  <div class="flex-1 flex flex-col overflow-hidden">

    <!-- Top Bar -->
    <header class="bg-white shadow-sm px-6 py-3 flex items-center justify-between flex-shrink-0">
      <h1 class="text-gray-700 font-semibold text-lg">หน้าหลัก</h1>
      <span class="text-sm text-gray-400"><?= date('d/m/') . (date('Y') + 543) ?></span>
    </header>

    <!-- Page Content -->
    <main class="flex-1 overflow-y-auto p-6">

      <!-- Welcome Card -->
      <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800">
          ยินดีต้อนรับ, <?= htmlspecialchars($name ?: $username) ?>
        </h2>
        <p class="text-gray-500 mt-1 text-sm">ระดับสิทธิ์:
          <span class="font-medium
            <?= $role === 'program' ? 'text-purple-600' : ($role === 'admin' ? 'text-blue-600' : 'text-gray-600') ?>">
            <?= $role === 'program' ? 'Programmer' : ($role === 'admin' ? 'Admin' : 'User') ?>
          </span>
        </p>
      </div>

      <!-- Menu Cards -->
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

        <?php
        $cards = [
          ['icon' => 'fa-cart-shopping', 'label' => 'Order',        'color' => 'bg-blue-500',   'min_level' => 1],
          ['icon' => 'fa-chart-bar',     'label' => 'รายงาน',       'color' => 'bg-green-500',  'min_level' => 2],
          ['icon' => 'fa-users',         'label' => 'จัดการผู้ใช้', 'color' => 'bg-orange-500', 'min_level' => 2],
          ['icon' => 'fa-gear',          'label' => 'ตั้งค่าระบบ',  'color' => 'bg-purple-500', 'min_level' => 3],
        ];
        foreach ($cards as $card):
          if ($role_level < $card['min_level']) continue;
        ?>
          <div class="bg-white rounded-xl shadow-sm p-5 flex flex-col items-center gap-3 cursor-pointer hover:shadow-md transition-shadow">
            <div class="h-12 w-12 rounded-full <?= $card['color'] ?> flex items-center justify-center">
              <i class="fa-solid <?= $card['icon'] ?> text-white text-lg"></i>
            </div>
            <span class="text-gray-700 font-medium text-sm"><?= $card['label'] ?></span>
          </div>
        <?php endforeach; ?>

      </div>

    </main>
  </div>

</div>
</body>
</html>
