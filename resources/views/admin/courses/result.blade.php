<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-poppins text-[#0A090B]">
<section id="content" class="flex">
  <!-- Sidebar -->
  <div id="sidebar" class="w-[270px] flex flex-col shrink-0 min-h-screen justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB]">
    <div class="w-full flex flex-col gap-[30px]">
      <a href="index.html" class="flex items-center justify-center">
        <img src="{{ asset('images/logo/logo-3.png') }}" alt="logo">
      </a>
      <ul class="flex flex-col gap-3">
        <li><h3 class="font-bold text-xs text-[#A5ABB2]">DAILY USE</h3></li>
        <li>
          <a href="{{ route('dashboard') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
            <img src="{{ asset('images/icons/home-hashtag.svg') }}" alt="icon">
            <p class="font-semibold transition-all duration-300 hover:text-white">Overview</p>
          </a>
        </li>
        <li>
          <a href="{{ route('dashboard.courses.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] text-white transition-all duration-300">
            <img src="{{ asset('images/icons/note-favorite.svg') }}" alt="icon">
            <p class="font-semibold">Courses</p>
          </a>
        </li>
        
      </ul>

      <ul class="flex flex-col gap-3">
        <li><h3 class="font-bold text-xs text-[#A5ABB2]">OTHERS</h3></li>
        <li>
          <a href="{{ route('profile.edit') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
            <img src="{{ asset('images/icons/setting-2.svg') }}" alt="icon">
            <p class="font-semibold transition-all duration-300 hover:text-white">Settings</p>
          </a>
        </li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
              <img src="{{ asset('images/icons/security-safe.svg') }}" alt="icon">
              <p class="font-semibold transition-all duration-300 hover:text-white">Logout</p>
            </button>
          </form>
        </li>
      </ul>
    </div>

    <!-- Get Pro Section -->
  </div>

  <!-- Content -->
  <div id="menu-content" class="flex flex-col w-full pb-[30px]">
    <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
      <form class="search flex items-center w-[400px] h-[52px] p-[10px_16px] rounded-full border border-[#EEEEEE]">
        <input type="text" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Search by report, student, etc" name="search">
        <button type="submit" class="ml-[10px] w-8 h-8 flex items-center justify-center">
          <img src="{{ asset('images/icons/search.svg') }}" alt="icon">
        </button>
      </form>
      <div class="flex items-center gap-[30px]">
        <div class="flex gap-[14px]">
          <a href="#" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
            <img src="{{ asset('images/icons/receipt-text.svg') }}" alt="icon">
          </a>
          <a href="#" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
            <img src="{{ asset('images/icons/notification.svg') }}" alt="icon">
          </a>
        </div>
        <div class="h-[46px] w-[1px] flex shrink-0 border border-[#EEEEEE]"></div>
        <div class="flex gap-3 items-center">
          <div class="flex flex-col text-right">
            <p class="text-sm text-[#7F8190]">Howdy</p>
            <p class="font-semibold">{{ Auth::user()->name }}</p>
          </div>
          <div class="w-[46px] h-[46px]">
            <img src="{{ asset('images/photos/default-photo.svg') }}" alt="photo">
          </div>
        </div>
      </div>
    </div>

    <!-- Course Management Header -->
    <div class="flex flex-col px-5 mt-5">
      <div class="w-full flex justify-between items-center">
        <div class="flex flex-col gap-1">
          <p class="font-extrabold text-[30px] leading-[45px]">Manage Course</p>
          <p class="text-[#7F8190]">Provide high quality for best students</p>
        </div>
        <a href="{{ route('dashboard.courses.export', $course->id) }}"
        class="h-[52px] px-5 py-[14px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D]"
        title="Cetak hasil evaluasi ke Excel"
        target="_blank"
        >
            Cetak Excel
        </a>
      </div>
    </div>

    <!-- Course Evaluation Results -->
    <div class="flex flex-col px-5 mt-[30px] gap-[30px]">
      <div class="container">
        <h1 class="mb-4 font-bold text-[24px] leading-[36px]">Hasil Evaluasi - {{ $course->name }}</h1>
        <p class="text-[#7F8190] mb-4">Total Soal: <strong>{{ $totalQuestions }}</strong></p>
        <div class="table-responsive">
          <table class="w-full border-collapse">
            <thead class="bg-[#F5F5F5]">
              <tr>
                <th class="p-[10px_16px] text-left font-semibold text-[#7F8190] text-sm">No</th>
                <th class="p-[10px_16px] text-left font-semibold text-[#7F8190] text-sm">Nama Siswa</th>
                <th class="p-[10px_16px] text-left font-semibold text-[#7F8190] text-sm">Email</th>
                <th class="p-[10px_16px] text-left font-semibold text-[#7F8190] text-sm">Jumlah Jawaban Benar</th>
                <th class="p-[10px_16px] text-left font-semibold text-[#7F8190] text-sm">Skor</th>
                <th class="p-[10px_16px] text-left font-semibold text-[#7F8190] text-sm">Grade</th>
                <th class="p-[10px_16px] text-left font-semibold text-[#7F8190] text-sm">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($results as $index => $result)
              <tr class="border-b border-[#EEEEEE] hover:bg-[#F9F9F9]">
                <td class="p-[10px_16px] font-semibold text-sm">{{ $index + 1 }}</td>
                <td class="p-[10px_16px] font-semibold text-sm">{{ $result['student']->name }}</td>
                <td class="p-[10px_16px] font-semibold text-sm">{{ $result['student']->email }}</td>
                <td class="p-[10px_16px] font-semibold text-sm">{{ $result['correctAnswers'] }} / {{ $totalQuestions }}</td>
                <td class="p-[10px_16px] font-semibold text-sm">{{ $result['score'] }}</td>
                <td class="p-[10px_16px] font-semibold text-sm">{{ $result['grade'] }}</td>
                <td class="p-[10px_16px]">
                  @if ($result['passed'])
                    <span class="p-[8px_16px] rounded-full bg-[#D5EFFE] font-bold text-sm text-[#066DFE]">Lulus</span>
                  @else
                    <span class="p-[8px_16px] rounded-full bg-[#FFE6E6] font-bold text-sm text-[#FD445E]">Tidak Lulus</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="p-[10px_16px] text-center font-semibold text-sm text-[#7F8190]">Belum ada data siswa yang mengikuti course ini.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>