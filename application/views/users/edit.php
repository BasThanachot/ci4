<?php if (!empty($error)): ?>
  <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-600 flex items-center gap-2">
    <i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<div class="max-w-lg bg-white rounded-xl shadow-sm p-6">
  <a href="<?= base_url('users/manage') ?>"
     class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-gray-600 mb-5">
    <i class="fa-solid fa-arrow-left text-xs"></i> กลับ
  </a>

  <form method="POST" action="<?= base_url('users/edit/' . $user->id) ?>" class="space-y-5">

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
      <input type="text" value="<?= htmlspecialchars($user->username) ?>" disabled
             class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-500">
    </div>

    <div>
      <label for="name" class="block text-sm font-medium text-gray-700 mb-1">ชื่อ-นามสกุล</label>
      <input id="name" type="text" name="name" value="<?= htmlspecialchars($user->name) ?>"
             class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div>
      <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
      <select id="role" name="role"
              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option value="user"    <?= $user->role === 'user'    ? 'selected' : '' ?>>User</option>
        <option value="admin"   <?= $user->role === 'admin'   ? 'selected' : '' ?>>Admin</option>
        <?php if ($role === 'program'): ?>
        <option value="program" <?= $user->role === 'program' ? 'selected' : '' ?>>Programmer</option>
        <?php endif; ?>
      </select>
    </div>

    <div class="border-t border-gray-100 pt-4">
      <p class="text-xs text-gray-400 mb-3">เปลี่ยน Password (เว้นว่างหากไม่ต้องการเปลี่ยน)</p>
      <div class="space-y-3">
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password ใหม่</label>
          <input id="password" type="password" name="password"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
          <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">ยืนยัน Password</label>
          <input id="confirm_password" type="password" name="confirm_password"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
      </div>
    </div>

    <div class="flex gap-3 pt-2">
      <button type="submit"
              class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold py-2 rounded-lg transition-colors">
        บันทึก
      </button>
      <a href="<?= base_url('users/manage') ?>"
         class="flex-1 text-center border border-gray-300 text-gray-600 hover:bg-gray-50 text-sm font-medium py-2 rounded-lg transition-colors">
        ยกเลิก
      </a>
    </div>

  </form>
</div>
