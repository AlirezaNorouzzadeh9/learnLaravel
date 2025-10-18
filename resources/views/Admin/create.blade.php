<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>فرم کاربر</title>
  <style>
    :root{
      --bg: #0f172a;
      --card: #0b1225cc;
      --border: #1f2a44;
      --text: #e5e7eb;
      --muted: #9ca3af;
      --accent: #6366f1;
      --radius: 16px;
    }
    *{ box-sizing: border-box; }
    html,body{ height:100%; }
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background:
        radial-gradient(1200px 600px at 80% -10%, #3b82f622, transparent 60%),
        radial-gradient(900px 500px at 0% 100%, #22d3ee22, transparent 60%),
        var(--bg);
      color: var(--text);
      display:grid;
      place-items:center;
      padding:24px;
    }
    .card{
      width:100%;
      max-width:420px;
      background: linear-gradient(180deg, #0b1225, #0b1225ee);
      border:1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: 0 10px 30px rgba(0,0,0,.40), inset 0 1px 0 rgba(255,255,255,.03);
      padding:24px;
      backdrop-filter: blur(6px);
    }
    .card h1{ font-size:20px; margin:0 0 4px 0; letter-spacing:.2px; }
    .card p.lead{ margin:0 0 22px 0; color:var(--muted); font-size:14px; }

    .field{ margin-bottom:16px; }
    label{ display:inline-block; margin-bottom:8px; font-size:13px; color:#cbd5e1; }

    input[type="text"],
    input[type="email"],
    input[type="password"]{
      width:100%;
      height:44px;
      border:1px solid var(--border);
      background:#0b1225;
      color:var(--text);
      border-radius:12px;
      padding:0 14px;
      outline:none;
      transition: border-color .2s, box-shadow .2s, transform .02s;
    }
    input::placeholder{ color:#64748b; }

    input:focus-visible{
      border-color: var(--accent);
      box-shadow: 0 0 0 4px #6366f133;
    }

    .hint{ margin-top:6px; font-size:12px; color:var(--muted); }

    .actions{
      margin-top:8px;
      display:flex;
      gap:10px;
      align-items:center;
      justify-content:space-between;
    }
    button{
      appearance:none; border:0; background:var(--accent); color:#fff; font-weight:600;
      padding:12px 16px; border-radius:12px; cursor:pointer;
      transition: transform .02s, filter .15s, background .2s;
    }
    button:hover{ filter:brightness(1.05); }
    button:active{ transform: translateY(1px); }
    .ghost{ background:transparent; border:1px solid var(--border); color:#cbd5e1; }

    .ltr { direction:ltr; text-align:left; }
  </style>
</head>
<body>
  <form class="card" action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    <h1>فرم کاربر</h1>
    <p class="lead">نام، ایمیل و گذرواژه خود را وارد کنید و روی «ذخیره» بزنید.</p>

    <div class="field">
      <label for="name">نام</label>
      <input type="text" id="name" name="name" placeholder="نام" autocomplete="name"/>
      @error('name')
        <p>{{ $message }}</p>
      @enderror
    </div>

    <div class="field">
      <label for="family">نام خانوادگی</label>
      <input type="text" id="family" name="family" placeholder="نام خانوادگی" autocomplete="family"/>
      @error('family')
        <p>{{ $message }}</p>
      @enderror
    </div>
        <div class="field">
      <label for="text">موبایل</label>
      <input type="text" id="phone" name="phone" placeholder="you@example.com" autocomplete="email"/>
      @error('phone')
        <p>{{ $message }}</p>
      @enderror
    </div>

    <div class="field">
      <label for="email">ایمیل</label>
      <input class="ltr" type="email" id="email" name="email" placeholder="you@example.com" autocomplete="email"/>
      @error('email')
        <p>{{ $message }}</p>
      @enderror
    </div>
    <div class="field">
      <label for="file">عکس</label>
      <input  type="file" id="image" name="image" />
      @error('image')
        <p>{{ $message }}</p>
      @enderror
    </div>

    <div class="field">
      <label for="password">گذرواژه</label>
      <input class="ltr" type="password" id="password" name="password" placeholder="گذرواژه" autocomplete="current-password"/>
      @error('password')
        <p>{{ $message }}</p>
      @enderror
    </div>

    <div class="actions">
      <button type="submit">ذخیره</button>
      <button type="reset" class="ghost">پاک کردن</button>
    </div>
  </form>

</body>
</html>
