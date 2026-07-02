<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
  <h2 class="text-xl font-bold text-gray-800">
    ยินดีต้อนรับ, <?= htmlspecialchars($name ?: $username) ?>
  </h2>
  <p class="text-gray-500 mt-1 text-sm">ระดับสิทธิ์:
    <span class="font-medium <?= $role === 'program' ? 'text-purple-600' : ($role === 'admin' ? 'text-blue-600' : 'text-gray-600') ?>">
      <?= $role === 'program' ? 'Programmer' : ($role === 'admin' ? 'Admin' : 'User') ?>
    </span>
  </p>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
  <?php
  $cards = [
    ['icon' => 'fa-cart-shopping', 'label' => 'Order',        'color' => 'bg-blue-500',   'min_level' => 1],
    ['icon' => 'fa-chart-bar',     'label' => 'รายงาน',       'color' => 'bg-green-500',  'min_level' => 2],
    ['icon' => 'fa-users',         'label' => 'จัดการผู้ใช้', 'color' => 'bg-orange-500', 'url' => 'users/manage', 'min_level' => 2],
    ['icon' => 'fa-gear',          'label' => 'ตั้งค่าระบบ',  'color' => 'bg-purple-500', 'min_level' => 3],
  ];
  foreach ($cards as $card):
    if ($role_level < $card['min_level']) continue;
    $url = isset($card['url']) ? base_url($card['url']) : '#';
  ?>
    <a href="<?= $url ?>" class="bg-white rounded-xl shadow-sm p-5 flex flex-col items-center gap-3 hover:shadow-md transition-shadow">
      <div class="h-12 w-12 rounded-full <?= $card['color'] ?> flex items-center justify-center">
        <i class="fa-solid <?= $card['icon'] ?> text-white text-lg"></i>
      </div>
      <span class="text-gray-700 font-medium text-sm"><?= $card['label'] ?></span>
    </a>
  <?php endforeach; ?>
</div>
