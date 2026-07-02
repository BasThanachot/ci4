<?php if (!empty($flash_success)): ?>
  <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700 flex items-center gap-2">
    <i class="fa-solid fa-circle-check"></i> <?= htmlspecialchars($flash_success) ?>
  </div>
<?php endif; ?>
<?php if (!empty($flash_error)): ?>
  <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-600 flex items-center gap-2">
    <i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($flash_error) ?>
  </div>
<?php endif; ?>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
  <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
    <div>
      <h2 class="font-semibold text-gray-700">รายการผู้ใช้ทั้งหมด</h2>
      <p class="text-xs text-gray-400 mt-0.5">ทั้งหมด <?= count($users) ?> คน</p>
    </div>
    <a href="<?= base_url('users/form') ?>"
       class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
      <i class="fa-solid fa-user-plus"></i> เพิ่มผู้ใช้
    </a>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
        <tr>
          <th class="px-6 py-3 text-left">#</th>
          <th class="px-6 py-3 text-left">Username</th>
          <th class="px-6 py-3 text-left">ชื่อ</th>
          <th class="px-6 py-3 text-left">Role</th>
          <th class="px-6 py-3 text-left">วันที่สร้าง</th>
          <th class="px-6 py-3 text-center">จัดการ</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        <?php if (empty($users)): ?>
          <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400">ไม่มีข้อมูลผู้ใช้</td></tr>
        <?php endif; ?>
        <?php foreach ($users as $i => $u): ?>
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 text-gray-400"><?= $i + 1 ?></td>
            <td class="px-6 py-4 font-medium text-gray-800">
              <?= htmlspecialchars($u->username) ?>
              <?php if ($u->id == $current_user_id): ?>
                <span class="ml-1 text-xs text-indigo-400">(คุณ)</span>
              <?php endif; ?>
            </td>
            <td class="px-6 py-4 text-gray-600"><?= htmlspecialchars($u->name ?: '-') ?></td>
            <td class="px-6 py-4">
              <?php
                $badge = [
                  'program' => 'bg-purple-100 text-purple-700',
                  'admin'   => 'bg-blue-100 text-blue-700',
                  'user'    => 'bg-gray-100 text-gray-600',
                ];
                $label = ['program' => 'Programmer', 'admin' => 'Admin', 'user' => 'User'];
              ?>
              <span class="px-2.5 py-1 rounded-full text-xs font-medium <?= $badge[$u->role] ?? 'bg-gray-100 text-gray-600' ?>">
                <?= $label[$u->role] ?? $u->role ?>
              </span>
            </td>
            <td class="px-6 py-4 text-gray-400">
              <?= date('d/m/', strtotime($u->created_at)) . (date('Y', strtotime($u->created_at)) + 543) ?>
            </td>
            <td class="px-6 py-4 text-center">
              <a href="<?= base_url('users/edit/' . $u->id) ?>"
                 class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-800 text-xs font-medium mr-3">
                <i class="fa-solid fa-pen-to-square"></i> แก้ไข
              </a>
              <a href="<?= base_url('users/history/' . $u->id) ?>"
                 class="inline-flex items-center gap-1 text-gray-400 hover:text-gray-600 text-xs font-medium mr-3">
                <i class="fa-solid fa-clock-rotate-left"></i> ประวัติ
              </a>
              <?php if ($u->id != $current_user_id): ?>
                <form action="<?= base_url('users/delete/' . $u->id) ?>" method="POST" class="inline"
                      onsubmit="return confirm('ยืนยันการลบ <?= htmlspecialchars($u->username) ?>?')">
                  <button type="submit"
                          class="inline-flex items-center gap-1 text-red-500 hover:text-red-700 text-xs font-medium">
                    <i class="fa-solid fa-trash"></i> ลบ
                  </button>
                </form>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
