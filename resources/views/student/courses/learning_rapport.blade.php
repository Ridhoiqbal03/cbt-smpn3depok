<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="text-[#0A090B] bg-white">

<div class="flex flex-col lg:flex-row min-h-screen">

  <!-- Sidebar -->
  <div id="sidebar" class="fixed lg:static z-50 top-0 left-0 w-64 h-full bg-[#FBFBFB] p-5 border-r border-[#EEEEEE] transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="flex flex-col gap-6">
      <a href="#" class="flex justify-center">
        <img src="{{ asset('images/logo/logo-3.png') }}" alt="logo" />
      </a>

      <ul class="flex flex-col gap-3">
        <li><h3 class="text-xs font-bold text-[#A5ABB2]">DAILY USE</h3></li>
        <li>
          <a href="{{route('dashboard')}}" class="flex items-center gap-3 p-3 rounded-full hover:bg-[#2B82FE] hover:text-white transition-all">
            <img src="{{ asset('images/icons/home-hashtag.svg') }}" alt="icon" />
            <p class="font-semibold">Overview</p>
          </a>
        </li>
        <li>
          <a href="{{ route('dashboard.learning.index') }}" class="flex items-center gap-3 p-3 rounded-full bg-[#2B82FE] text-white font-semibold">
            <img src="{{ asset('images/icons/note-favorite.svg') }}" alt="icon" />
            <p>Courses</p>
          </a>
        </li>
      </ul>

      <ul class="flex flex-col gap-3 mt-4">
        <li><h3 class="text-xs font-bold text-[#A5ABB2]">OTHERS</h3></li>
        <li>
          <a href="{{route('profile.edit')}}" class="flex items-center gap-3 p-3 rounded-full hover:bg-[#2B82FE] hover:text-white transition-all">
            <img src="{{ asset('images/icons/setting-2.svg') }}" alt="icon" />
            <p class="font-semibold">Settings</p>
          </a>
        </li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 p-3 rounded-full hover:bg-[#2B82FE] hover:text-white transition-all">
              <img src="{{ asset('images/icons/security-safe.svg') }}" alt="icon" />
              <p class="font-semibold">Logout</p>
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>

  <!-- Overlay for mobile -->
  <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 lg:hidden"></div>

  <!-- Main -->
  <div class="flex flex-col flex-1 min-h-screen">

    <!-- Navbar -->
    <header class="flex items-center justify-between p-4 border-b border-[#EEEEEE] bg-white">
      <button id="hamburgerBtn" class="lg:hidden w-10 h-10 border border-[#EEEEEE] rounded-full flex items-center justify-center">
        <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <form class="flex-grow max-w-md mx-4 hidden sm:flex items-center h-[52px] px-4 rounded-full border border-[#EEEEEE]">
        <input type="text" class="w-full outline-none placeholder:text-[#7F8190]" placeholder="Search...">
        <button type="submit" class="ml-2 w-6 h-6 flex items-center justify-center">
          <img src="{{ asset('images/icons/search.svg') }}" alt="search">
        </button>
      </form>

      <div class="flex items-center gap-4">
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-[#EEEEEE]">
          <img src="{{ asset('images/icons/notification.svg') }}" alt="notif" />
        </a>
        <div class="h-10 w-px bg-[#EEEEEE]"></div>
        <div class="flex items-center gap-2">
          <div class="text-right text-sm">
            <p class="text-[#7F8190]">Howdy</p>
            <p class="font-semibold">{{ Auth::user()->name }}</p>
          </div>
          <img src="{{ asset('images/photos/default-photo.svg') }}" class="w-10 h-10 rounded-full" alt="user photo" />
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 p-5 space-y-5 overflow-y-auto">
     <div class="text-sm text-[#7F8190] hidden lg:block">
  <a href="{{ route('dashboard') }}" class="hover:underline">Home</a> /
  <a href="{{ route('dashboard.learning.index') }}" class="hover:underline">My Courses</a> /
  <span class="font-semibold text-black">Rapport Details</span>
</div>


      <div class="flex flex-col lg:flex-row justify-between items-start gap-5">
        <div class="flex flex-col sm:flex-row gap-4">
          <div class="w-36 h-36 relative shrink-0">
            <img src="{{ Storage::url($course->cover) }}" alt="cover" class="w-full h-full object-contain">
            <p class="absolute bottom-0 left-1/2 -translate-x-1/2 bg-[#FFF2E6] text-sm text-[#F6770B] font-bold px-3 py-1 rounded-full">
              {{ $course->category->name }}
            </p>
          </div>
          <div>
            <h1 class="text-2xl font-extrabold">{{ $course->name }}</h1>
            <div class="flex items-center gap-2 mt-2 flex-wrap">
              <img src="{{ asset('images/icons/note-text.svg') }}" class="w-5 h-5" />
              <p class="font-semibold">{{ $correctAnswersCount }} of {{ $totalQuestions }} Correct</p>
            </div>
          </div>
        </div>
        <div class="flex flex-col sm:flex-row gap-4">
          <p class="px-5 py-3 text-white font-bold text-lg rounded-[10px] {{ $passed ? 'bg-[#06BC65] outline-[#06BC65]' : 'bg-[#FD445E] outline-[#FD445E]' }} outline-dashed outline-[3px] outline-offset-4 text-center">
            {{ $passed ? 'Passed' : 'Not Passed' }}
          </p>
          <div>
            <p class="text-lg font-semibold">Score: {{ $score }}%</p>
            <p class="text-sm text-[#7F8190]">Grade: <span class="font-bold">{{ $grade }}</span></p>
          </div>
        </div>
      </div>

      <div class="space-y-4">
        @forelse($studentAnswers as $answer)
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 p-4 border border-[#EEEEEE] rounded-xl">
          <div class="break-words">
            <p class="text-[#7F8190]">Question</p>
            <p class="font-bold text-lg">{{ $answer->question->question }}</p>
          </div>
          <p class="px-4 py-2 rounded-full font-semibold text-sm text-white {{ $answer->answer == 'correct' ? 'bg-[#06BC65]' : 'bg-[#FD445E]' }}">
            {{ $answer->answer }}
          </p>
        </div>
        @empty
        <p class="text-center text-[#7F8190]">Belum Ada Jawaban!</p>
        @endforelse
      </div>

     
    </main>
  </div>
</div>

<!-- Script -->
<script>
  const hamburgerBtn = document.getElementById('hamburgerBtn');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');

  hamburgerBtn.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
  });

  overlay.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
  });
</script>

</body>
</html>
