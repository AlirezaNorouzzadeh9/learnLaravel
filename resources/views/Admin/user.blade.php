<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ویرایش کاربر</title>
  <style>
    body{margin:0; font-family:Tahoma,Arial,sans-serif; background:#0f172a; color:#e5e7eb; display:flex; justify-content:center; align-items:center; height:100vh;}
    .card{background:#111827; border:1px solid #1f2937; border-radius:12px; padding:24px; width:100%; max-width:420px;}
    h1{margin-top:0; font-size:20px;}
    .field{margin-bottom:16px;}
    label{display:block; margin-bottom:6px; font-size:13px; color:#cbd5e1;}
    input{width:100%; height:40px; border:1px solid #374151; background:#0b1225; color:#e5e7eb; border-radius:8px; padding:0 10px;}
    input:focus{border-color:#6366f1; outline:none; box-shadow:0 0 0 3px #6366f155;}
    .actions{margin-top:20px; display:flex; justify-content:space-between; gap:8px;}
    .btn{padding:10px 16px; border:none; border-radius:8px; cursor:pointer; font-weight:bold;}
    .btn.primary{background:#6366f1; color:white;}
    .btn.secondary{background:transparent; border:1px solid #374151; color:#cbd5e1;}
    .ltr{direction:ltr; text-align:left;}
  </style>
</head>
<body>
  <form class="card" action="{{ route('admin.user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <h1>ویرایش کاربر</h1>

    <div class="field">
      <label for="name">نام</label>
      <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required minlength="2">
    </div>

    <div class="field">
      <label for="email">ایمیل</label>
      <input class="ltr" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="field">
      <label for="password">گذرواژه جدید (اختیاری)</label>
      <input class="ltr" type="password" id="password" name="password" placeholder="اگر خالی بگذاری تغییر نمی‌کند">
    </div>

    <div class="actions">
      <button type="submit" class="btn primary">ذخیره تغییرات</button>
      <a href="{{ route('admin.users') }}" class="btn secondary">بازگشت</a>
    </div>
  </form>
</body>
</html>
