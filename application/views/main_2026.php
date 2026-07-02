<!doctype html>
<html class="h-full bg-white">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>เข้าสู่ระบบ - Ci</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="icon" href="<?= base_url('assets/images/66-1.png') ?>">
</head>

<body class="h-full">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img src="<?= base_url('assets/images/66-1.png') ?>" class="h-[250px] w-[250px] mx-auto" />
      
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
        Sign in to Ci
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form action="<?= base_url('auth/login') ?>" method="POST" class="space-y-6">
        <div>
          <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
          <div class="mt-2">
            <input id="username" type="username" name="username" required autocomplete="username" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
          </div>
          <div class="mt-2">
            <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
          </div>
        </div>

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm/6 text-gray-500">
        <a href="<?= base_url('users/form') ?>" class="font-semibold text-indigo-600 hover:text-indigo-500">ลงทะเบียน</a>
      </p>
    </div>
    <?php if (!empty($success)): ?>
      <div class="mt-4 rounded-md bg-green-50 p-3 text-sm text-green-700">
        <?= htmlspecialchars($success) ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
      <div class="mt-4 rounded-md bg-red-50 p-3 text-sm text-red-600">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>
  </div>
  
</body>

</html>