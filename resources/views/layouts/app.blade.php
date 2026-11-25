<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Training Institute</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
        nav a { margin-right: 1rem; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: .5rem; text-align: left; }
        .success { background: #e6ffed; padding: .75rem; border: 1px solid #2da44e; }
        .errors { background: #ffeef0; padding: .75rem; border: 1px solid #d73a49; }
        .field { margin-bottom: 1rem; }
        label { display: block; font-weight: bold; }
        input[type=text], input[type=email], input[type=number], input[type=date], select, textarea { width: 100%; padding: .4rem; box-sizing: border-box; }
    </style>
</head>
<body>
    <nav>
        <a href="/students">Students</a>
        {{-- Courses link is added in Milestone 4 --}}
    </nav>
    <hr>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <div class="errors">
            <h3>Please fix the following errors:</h3>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</body>
</html>