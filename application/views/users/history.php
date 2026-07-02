<div class="mb-4">
  <a href="<?= base_url('users/manage') ?>"
     class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-gray-600">
    <i class="fa-solid fa-arrow-left text-xs"></i> กลับ
  </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
  <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
    <div class="h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
      <?= mb_substr($user->name ?: $user->username, 0, 1) ?>
    </div>
    <div>
      <h2 class="font-semibold text-gray-700"><?= htmlspecialchars($user->username) ?></h2>
      <p class="text-xs text-gray-400"><?= htmlspecialchars($user->name ?: '-') ?> · ทั้งหมด <?= count($logs) ?> รายการ</p>
    </div>
  </div>

  <?php if (empty($logs)): ?>
    <div class="px-6 py-12 text-center text-gray-400">
      <i class="fa-solid fa-clock-rotate-left text-3xl mb-3 block"></i>
      ยังไม่มีประวัติการแก้ไข
    </div>
  <?php else: ?>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
          <tr>
            <th class="px-6 py-3 text-left w-44">วันที่/เวลา</th>
            <th class="px-6 py-3 text-left">แก้ไขโดย</th>
            <th class="px-6 py-3 text-left">ฟิลด์</th>
            <th class="px-6 py-3 text-left">ค่าเดิม</th>
            <th class="px-6 py-3 text-left">ค่าใหม่</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <?php foreach ($logs as $log): ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3 text-gray-400 whitespace-nowrap">
                <?php
                  $ts = strtotime($log->created_at);
                  echo date('d/m/', $ts) . (date('Y', $ts) + 543) . date(' H:i:s', $ts);
                ?>
              </td>
              <td class="px-6 py-3">
                <span class="font-medium text-gray-700">
                  <?= htmlspecialchars($log->changed_by_username) ?>
                </span>
              </td>
              <td class="px-6 py-3">
                <span class="px-2 py-0.5 rounded bg-gray-100 text-gray-600 text-xs font-medium">
                  <?= $log_model->field_label($log->field) ?>
                </span>
              </td>
              <td class="px-6 py-3 text-gray-500">
                <?php if ($log->field === 'password'): ?>
                  <span class="text-gray-400 italic"><?= $log->old_value ?></span>
                <?php elseif ($log->field === 'role'): ?>
                  <?php
                    $badge = ['program' => 'bg-purple-100 text-purple-700', 'admin' => 'bg-blue-100 text-blue-700', 'user' => 'bg-gray-100 text-gray-600'];
                    $cls = $badge[$log->old_value] ?? 'bg-gray-100 text-gray-600';
                  ?>
                  <span class="px-2 py-0.5 rounded-full text-xs font-medium <?= $cls ?>">
                    <?= $log_model->display_value('role', $log->old_value) ?>
                  </span>
                <?php else: ?>
                  <?= htmlspecialchars($log->old_value ?? '-') ?>
                <?php endif; ?>
              </td>
              <td class="px-6 py-3 text-gray-800 font-medium">
                <?php if ($log->field === 'password'): ?>
                  <span class="text-gray-400 italic"><?= $log->new_value ?></span>
                <?php elseif ($log->field === 'role'): ?>
                  <?php
                    $cls = $badge[$log->new_value] ?? 'bg-gray-100 text-gray-600';
                  ?>
                  <span class="px-2 py-0.5 rounded-full text-xs font-medium <?= $cls ?>">
                    <?= $log_model->display_value('role', $log->new_value) ?>
                  </span>
                <?php else: ?>
                  <?= htmlspecialchars($log->new_value ?? '-') ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
