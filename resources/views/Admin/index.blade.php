<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مدیریت کاربران</title>
  <style>
    :root{
      --bg:#0f172a; --card:#111827; --text:#e5e7eb; --muted:#9ca3af;
      --border:#1f2937; --primary:#6366f1; --danger:#ef4444;
    }
    *{box-sizing:border-box}
    body{margin:0; font-family:IRANSans,ui-sans-serif,system-ui; background:var(--bg); color:var(--text)}
    .container{max-width:1000px; margin:40px auto; padding:0 16px}
    .header{display:flex; align-items:center; justify-content:space-between; margin-bottom:16px}
    .card{background:var(--card); border:1px solid var(--border); border-radius:14px; padding:16px}
    table{width:100%; border-collapse:collapse}
    th, td{padding:12px 10px; border-bottom:1px solid var(--border); text-align:right}
    th{font-weight:700; color:#cbd5e1}
    tr:hover td{background:#0b1225}
    .actions{display:flex; gap:8px}
    .btn{display:inline-flex; align-items:center; justify-content:center; padding:8px 12px; border-radius:10px; border:1px solid var(--border); color:var(--text); text-decoration:none; cursor:pointer}
    .btn.primary{background:var(--primary); border-color:transparent; color:white}
    .btn.danger{background:var(--danger); border-color:transparent; color:white}
    .muted{color:var(--muted)}
    .empty{padding:18px; text-align:center; color:var(--muted)}
    .pagination{margin-top:12px}
    .ltr{direction:ltr; text-align:left}
    img.avatar{height:50px; width:50px; border-radius:50%; object-fit:cover}
  </style>
</head>
<body>
  @if (session()->has('message'))
      <p>{{ session('message') }}</p>
  @endif

  <div class="container">
    <div class="header">
      <h1>{{ __('message.main') }}</h1>
      <a class="btn primary" href="{{ route('admin.user.create') }}">کاربر جدید</a>
    </div>
    
    <div class="">
      <table>
        <thead>
          <tr>
            <th style="width:56px">عکس</th>
            <th>نام</th>
            <th>تاریخ ساخت</th>
            <th>وضعیت</th>
            <th>شماره</th>
            <th style="width:260px">عملیات</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
            <tr>
              <td>
                <img class="avatar" src="{{url('/images/' . $user->image)}}" alt="avatar">
              </td>
              <td>{{ $user->full_name }}</td>
              <td>{{ $user->created_at }}</td>
              <td>{{ $user->user_status }}</td>
              <td>{{ $user->phone }}</td>
              <td>
                <div class="actions">
                  <a href="{{ route('admin.user', $user->id) }}" class="btn">ویرایش</a>
                  
                    <form action="{{ route('admin.user.download', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn ">دانلود</button>
                  </form>
                  
                  <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                        onsubmit="return confirm('کاربر حذف شود؟ این عمل قابل بازگشت نیست.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn danger">حذف</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="empty">هیچ کاربری یافت نشد.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
