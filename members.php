<?php
require 'con.php';
$msg = '';

// DELETE
if (isset($_GET['del'])) {
    mysqli_query($conn, "DELETE FROM members WHERE id=".(int)$_GET['del']);
    $msg = 'ลบข้อมูลสำเร็จ';
}

// โหลดแก้ไข
$edit = null;
if (isset($_GET['edit'])) {
    $res  = mysqli_query($conn, "SELECT * FROM members WHERE id=".(int)$_GET['edit']);
    $edit = mysqli_fetch_assoc($res);
}

// UPDATE
if (isset($_POST['update'])) {
    $id  = (int)$_POST['id'];
    $fn  = $_POST['fullname'];
    $em  = $_POST['email'];
    $pw  = $_POST['password'];

    if (empty($fn) || empty($em) || empty($pw)) {
        $msg = 'กรุณากรอกข้อมูลให้ครบ';
    } elseif (strpos($em, '@') === false) {
        $msg = 'อีเมลไม่ถูกต้อง';
    } elseif (strlen($pw) < 8) {
        $msg = 'รหัสผ่านต้องมีอย่างน้อย 8 ตัว';
    } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM members WHERE email='$em' AND id!=$id")) > 0) {
        $msg = 'อีเมลนี้ถูกใช้งานแล้ว';
    } else {
        mysqli_query($conn, "UPDATE members SET fullname='$fn',email='$em',password='$pw' WHERE id=$id");
        $msg = 'แก้ไขข้อมูลสำเร็จ';
        $edit = null;
    }

    if ($msg != 'แก้ไขข้อมูลสำเร็จ') {
        $edit = ['id'=>$id,'fullname'=>$fn,'email'=>$em,'password'=>$pw];
    }
}

// INSERT
if (isset($_POST['insert'])) {
    $fn = $_POST['fullname'];
    $em = $_POST['email'];
    $pw = $_POST['password'];

    if (empty($fn) || empty($em) || empty($pw)) {
        $msg = 'กรุณากรอกข้อมูลให้ครบ';
    } elseif (strpos($em, '@') === false) {
        $msg = 'อีเมลไม่ถูกต้อง';
    } elseif (strlen($pw) < 8) {
        $msg = 'รหัสผ่านต้องมีอย่างน้อย 8 ตัว';
    } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM members WHERE email='$em'")) > 0) {
        $msg = 'อีเมลนี้ถูกใช้งานแล้ว';
    } else {
        mysqli_query($conn, "INSERT INTO members (fullname,email,password) VALUES ('$fn','$em','$pw')");
        $msg = 'เพิ่มข้อมูลสำเร็จ';
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ระบบจัดการพนักงาน</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 20px; }
    h2   { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 8px; }
    input { padding: 6px; margin: 4px 0 8px; width: 250px; display: block; }
    button, .btn { padding: 7px 16px; background: #3498db; color: #fff; border: none; cursor: pointer; border-radius: 4px; text-decoration: none; }
    .green { background: #27ae60; }
    .red   { background: #e74c3c; }
    table  { border-collapse: collapse; width: 100%; background: #fff; margin-top: 10px; }
    th { background: #3498db; color: #fff; padding: 8px 12px; text-align: left; }
    td { padding: 8px 12px; border-bottom: 1px solid #ddd; }
    tr:hover td { background: #f0f8ff; }
    .msg  { padding: 8px; background: #d4edda; color: #155724; border-left: 4px solid #28a745; margin-bottom: 10px; }
    .err  { background: #f8d7da; color: #721c24; border-left-color: #dc3545; }
  </style>
</head>
<body>

<h2>ระบบจัดการพนักงาน</h2>

<?php if ($msg): ?>
  <?php $ok = strpos($msg, 'สำเร็จ') !== false; ?>
  <p class="msg <?= $ok ? '' : 'err' ?>"><?= $msg ?></p>
<?php endif; ?>

<?php if ($edit): ?>
  <h3>แก้ไขข้อมูล</h3>
  <form method="post">
    <input type="hidden" name="id" value="<?= $edit['id'] ?>">
    <label>ชื่อ-นามสกุล</label>
    <input type="text" name="fullname" value="<?= $edit['fullname'] ?>">
    <label>อีเมล</label>
    <input type="text" name="email" value="<?= $edit['email'] ?>">
    <label>รหัสผ่าน (ไม่เกิน 8 ตัว)</label>
    <input type="text" name="password" value="<?= $edit['password'] ?>">
    <button type="submit" name="update" class="green">บันทึก</button>
    <a href="members.php" class="btn">ยกเลิก</a>
  </form>

<?php else: ?>
  <h3>เพิ่มพนักงาน</h3>
  <form method="post">
    <label>ชื่อ-นามสกุล</label>
    <input type="text" name="fullname" value="<?= $_POST['fullname'] ?? '' ?>">
    <label>อีเมล</label>
    <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>">
    <label>รหัสผ่าน (ไม่เกิน 8 ตัว)</label>
    <input type="password" name="password">
    <button type="submit" name="insert">เพิ่มข้อมูล</button>
  </form>
<?php endif; ?>

<hr>
<h3>รายชื่อพนักงาน</h3>
<table>
  <tr>
    <th>#</th><th>ชื่อ-นามสกุล</th><th>อีเมล</th><th>รหัสผ่าน</th><th>จัดการ</th>
  </tr>
  <?php
  $sql="SELECT * FROM members ORDER BY id DESC";
print $sql;
    $ck=$conn->query($sql);$c_arc=$c=0;
    $cc= @$ck->rowcount(); //print $cc;
    if ($cc>0){
    while ($row = $ck->fetch()) {$c++;
            $fullname[$c]=$row['fullname']; 
            $email[$c]=$row['email']; if($email[$c]=="")$email[$c]="n/a" ;
    }}

  // $result = mysqli_query($conn, "SELECT * FROM members ORDER BY id DESC");
  // $i = 1;
  // while ($row = mysqli_fetch_assoc($result)):
  ?>
  <tr>
    <td><?= $c ?></td>
    <td><?= $row['fullname'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['password'] ?></td>
    <td>
      <a href="?edit=<?= $row['id'] ?>" class="btn">แก้ไข</a>
      <a href="?del=<?= $row['id'] ?>" class="btn red" onclick="return confirm('ยืนยันลบ?')">ลบ</a>
    </td>
  </tr>
  <?php //endwhile; ?>
</table>

</body>
</html>
