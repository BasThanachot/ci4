<!doctype html>
<html class="h-full bg-white">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ลงทะเบียน - GLIN</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="icon" href="<?= base_url('assets/images/66-1.png') ?>">
</head>

<body class="h-full">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img src="<?= base_url('assets/images/66-1.png') ?>" class="h-[250px] w-[250px] mx-auto" />
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
        ลงทะเบียน Ci
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

      <?php if (!empty($error)): ?>
        <div class="mb-4 rounded-md bg-red-50 p-3 text-sm text-red-600">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('users/form') ?>" method="POST" class="space-y-5">

        <div>
          <label for="name" class="block text-sm/6 font-medium text-gray-900">ชื่อ-นามสกุล</label>
          <div class="mt-2">
            <input id="name" type="text" name="name" autocomplete="name"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
          </div>
        </div>

        <div>
          <label for="username" class="block text-sm/6 font-medium text-gray-900">Username <span class="text-red-500">*</span></label>
          <div class="mt-2">
            <input id="username" type="text" name="username" required autocomplete="username"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password <span class="text-red-500">*</span></label>
          <div class="mt-2">
            <input id="password" type="password" name="password" required autocomplete="new-password"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
          </div>
        </div>

        <div>
          <label for="confirm_password" class="block text-sm/6 font-medium text-gray-900">ยืนยัน Password <span class="text-red-500">*</span></label>
          <div class="mt-2">
            <input id="confirm_password" type="password" name="confirm_password" required autocomplete="new-password"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
          </div>
        </div>

        <div>
          <button type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            ลงทะเบียน
          </button>
        </div>
      </form>

      <p class="mt-6 text-center text-sm/6 text-gray-500">
        มีบัญชีแล้ว?
        <a href="<?= base_url() ?>" class="font-semibold text-indigo-600 hover:text-indigo-500">เข้าสู่ระบบ</a>
      </p>
    </div>
  </div>
</body>

</html>
