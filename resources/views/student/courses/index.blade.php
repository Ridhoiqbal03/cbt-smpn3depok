<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="{{asset('css/output.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    .hamburger-line {
        width: 24px;
        height: 3px;
        background-color: #0A090B;
        margin: 4px 0;
        transition: 0.4s;
    }
  </style>
</head>
<body class="font-poppins text-[#0A090B]">
    <section class="flex min-h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed md:static top-0 left-0 w-[270px] h-full bg-[#FBFBFB] border-r border-[#EEEEEE] flex flex-col justify-between p-[30px] z-50 transition-transform transform -translate-x-full md:translate-x-0 md:relative md:translate-x-0 duration-300">
            <div class="w-full flex flex-col gap-[30px]">
                <a href="index.html" class="flex items-center justify-center">
                    <img src="{{asset('images/logo/logo-3.png')}}" alt="logo">
                </a>
                <ul class="flex flex-col gap-3">
                    <li><h3 class="font-bold text-xs text-[#A5ABB2]">DAILY USE</h3></li>
                    <li>
                        <a href="{{route('dashboard')}}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 hover:bg-[#2B82FE] transition-all duration-300">
                            <img src="{{asset('images/icons/home-hashtag.svg')}}" alt="icon">
                            <p class="font-semibold hover:text-white transition-all duration-300">Overview</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.learning.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] hover:bg-[#2B82FE] transition-all duration-300">
                            <img src="{{asset('images/icons/note-favorite.svg')}}" alt="icon">
                            <p class="font-semibold text-white">Courses</p>
                        </a>
                    </li>
                </ul>
                <ul class="flex flex-col gap-3">
                    <li><h3 class="font-bold text-xs text-[#A5ABB2]">OTHERS</h3></li>
                    <li>
                        <a href="{{route('profile.edit')}}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 hover:bg-[#2B82FE] transition-all duration-300">
                            <img src="{{asset('images/icons/setting-2.svg')}}" alt="icon">
                            <p class="font-semibold hover:text-white transition-all duration-300">Settings</p>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 hover:bg-[#2B82FE] transition-all duration-300">
                                <img src="{{asset('images/icons/security-safe.svg')}}" alt="icon">
                                <p class="font-semibold hover:text-white transition-all duration-300">Logout</p>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Overlay untuk mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 min-h-screen">
            <!-- Mobile Navbar -->
            <div class="md:hidden flex items-center justify-between px-5 py-4 border-b border-[#EEEEEE]">
                <button onclick="toggleSidebar()" class="focus:outline-none">
                    <div class="hamburger-line"></div>
                    <div class="hamburger-line"></div>
                    <div class="hamburger-line"></div>
                </button>
                <div class="text-right">
                    <p class="text-sm text-[#7F8190]">Howdy</p>
                    <p class="font-semibold">{{ Auth::user()->name }}</p>
                </div>
            </div>

            <!-- Desktop Navbar -->
            <div class="hidden md:flex justify-between p-5 border-b border-[#EEEEEE]">
                <form class="search flex items-center w-[400px] h-[52px] p-[10px_16px] rounded-full border border-[#EEEEEE]">
                    <input type="text" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Search by report, student, etc" name="search">
                    <button type="submit" class="ml-[10px] w-8 h-8 flex items-center justify-center">
                        <img src="{{asset('images/icons/search.svg')}}" alt="icon">
                    </button>
                </form>
                <div class="flex items-center gap-[30px]">
                    <div class="flex gap-[14px]">
                        <a href="#" class="w-[46px] h-[46px] flex items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="{{asset('images/icons/receipt-text.svg')}}" alt="icon">
                        </a>
                        <a href="#" class="w-[46px] h-[46px] flex items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="{{asset('images/icons/notification.svg')}}" alt="icon">
                        </a>
                    </div>
                    <div class="h-[46px] w-[1px] border border-[#EEEEEE]"></div>
                    <div class="flex gap-3 items-center">
                        <div class="flex flex-col text-right">
                            <p class="text-sm text-[#7F8190]">Howdy</p>
                            <p class="font-semibold">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="w-[46px] h-[46px]">
                            <img src="{{asset('images/photos/default-photo.svg')}}" alt="photo">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header -->
            <div class="px-5 mt-5">
                <div class="flex flex-col gap-1">
                    <p class="font-extrabold text-[24px] md:text-[30px] leading-[36px] md:leading-[45px]">My Courses</p>
                    <p class="text-[#7F8190] text-sm">Finish all given tests to grow</p>
                </div>
            </div>

            <!-- Course List -->
            <div class="flex flex-col px-5 mt-[30px] gap-[30px]">
                <!-- Header -->
                <div class="hidden md:flex justify-between pb-4 pr-10 border-b border-[#EEEEEE] text-[#7F8190] text-sm">
                    <div class="w-[300px]">Course</div>
                    <div class="w-[150px] text-center">Date Created</div>
                    <div class="w-[170px] text-center">Category</div>
                    <div class="w-[120px] text-center">Action</div>
                </div>

                <!-- Items -->
                @forelse($my_courses as $course)
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between pr-4 gap-4">
                        <div class="flex items-center gap-4 md:w-[300px]">
                            <img src="{{Storage::url($course->cover)}}" class="w-16 h-16 rounded-full object-cover" alt="thumbnail">
                            <div class="flex flex-col">
                                <p class="font-bold text-lg">{{ $course->name }}</p>
                                <p class="text-[#7F8190] text-sm">Beginners</p>
                            </div>
                        </div>
                        <div class="md:w-[150px] text-sm text-center">{{ \Carbon\Carbon::parse($course->created_at)->format('F j, Y') }}</div>
                        <div class="md:w-[170px] text-center">
                            @if ($course->category->name =='Product Design')
                                <span class="bg-[#FFF2E6] text-[#F6770B] p-2 rounded-full text-sm font-bold">{{ $course->category->name }}</span>
                            @elseif ($course->category->name =='Programming')
                                <span class="bg-[#EAE8FE] text-[#6436F1] p-2 rounded-full text-sm font-bold">{{ $course->category->name }}</span>
                            @elseif ($course->category->name =='Digital Marketing')
                                <span class="bg-[#D5EFFE] text-[#066DFE] p-2 rounded-full text-sm font-bold">{{ $course->category->name }}</span>
                            @endif
                        </div>
                        <div class="md:w-[120px]">
                            @if($course->nextQuestionId !== null)
                                <a href="{{ route('dashboard.learning.course', ['course'=> $course->id, 'question'=>$course->nextQuestionId]) }}"
                                   class="block w-full text-center bg-[#6436F1] text-white rounded-full py-2 text-sm font-bold">
                                   Start Test
                                </a>
                            @else
                                <a href="{{ route('dashboard.learning.rapport.course', $course) }}"
                                   class="block w-full text-center bg-indigo-950 text-white rounded-full py-2 text-sm font-bold">
                                   Result
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-center text-[#7F8190]">Belum ada Kelas yang diberikan</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Toggle Sidebar Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>
