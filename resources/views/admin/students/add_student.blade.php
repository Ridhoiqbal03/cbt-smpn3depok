<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{asset('css/output.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body class="font-poppins text-[#0A090B]">
    <section id="content" class="flex">
        <div id="sidebar"
            class="w-[270px] flex flex-col shrink-0 min-h-screen justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB]">
            <div class="w-full flex flex-col gap-[30px]">
                <a href="index.html" class="flex items-center justify-center">
                    <img src="{{asset('images/logo/logo-3.png')}}" alt="logo">
                </a>
                <ul class="flex flex-col gap-3">
                    <li>
                        <h3 class="font-bold text-xs text-[#A5ABB2]">DAILY USE</h3>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{asset('images/icons/home-hashtag.svg')}}" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Overview</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.courses.index') }}"
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{asset('images/icons/note-favorite.svg')}}" alt="icon">
                            </div>
                            <p class="font-semibold text-white transition-all duration-300 hover:text-white">Courses</p>
                        </a>
                    </li>
                    
                </ul>
                <ul class="flex flex-col gap-3">
                    <li>
                        <h3 class="font-bold text-xs text-[#A5ABB2]">OTHERS</h3>
                    </li>
                    
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{asset('images/icons/setting-2.svg')}}" alt="icon">
                            </div>
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
            
        </div>
        <div id="menu-content" class="flex flex-col w-full pb-[30px]">
            <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
                <form
                    class="search flex items-center w-[400px] h-[52px] p-[10px_16px] rounded-full border border-[#EEEEEE]">
                    <input type="text"
                        class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                        placeholder="Search by report, student, etc" name="search">
                    <button type="submit" class="ml-[10px] w-8 h-8 flex items-center justify-center">
                        <img src="{{asset('images/icons/search.svg')}}" alt="icon">
                    </button>
                </form>
                <div class="flex items-center gap-[30px]">
                    <div class="flex gap-[14px]">
                        <a href=""
                            class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="{{asset('images/icons/receipt-text.svg')}}" alt="icon">
                        </a>
                        <a href=""
                            class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="{{asset('images/icons/notification.svg')}}" alt="icon">
                        </a>
                    </div>
                    <div class="h-[46px] w-[1px] flex shrink-0 border border-[#EEEEEE]"></div>
                    <div class="flex gap-3 items-center">
                        <div class="flex flex-col text-right">
                            <p class="text-sm text-[#7F8190]">Howdy</p>
                            <p class="font-semibold">Fany Alqo</p>
                        </div>
                        <div class="w-[46px] h-[46px]">
                            <img src="{{asset('images/photos/default-photo.svg')}}" alt="photo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-10 px-5 mt-5">
                <div class="breadcrumb flex items-center gap-[30px]">
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Home</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="{{ route('dashboard.courses.show', $course) }}" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Manage Courses</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Course Students</a>
                </div>
            </div>
            <div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
                <div class="flex gap-6 items-center">
                    <div class="w-[150px] h-[150px] flex shrink-0 relative overflow-hidden">
                        <img src="{{Storage::url($course->cover)}}" class="w-full h-full object-contain"
                            alt="icon">
                        <p
                            class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B] absolute bottom-0 transform -translate-x-1/2 left-1/2 text-nowrap">
                            {{ $course->category->name }}</p>
                    </div>
                    <div class="flex flex-col gap-5">
                        <h1 class="font-extrabold text-[30px] leading-[45px]">{{ $course->name }}</h1>
                        <div class="flex items-center gap-5">
                            <div class="flex gap-[10px] items-center">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="{{asset('images/icons/calendar-add.svg')}}" alt="icon">
                                </div>
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($course->created_at)-> format('F j, Y') }}</p>
                            </div>
                            <div class="flex gap-[10px] items-center">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="{{asset('images/icons/profile-2user-outline.svg')}}" alt="icon">
                                </div>
                                <p class="font-semibold">{{ count($students) }} Students</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $errors)
                    <li class="py-5 px-5 bg-red-700 text-white " >
                        {{ $errors }}
                    </li>
                    @endforeach
                </ul>
            @endif
            @if(session('success'))
                <div id="success-alert" class="mx-[70px] mt-5 mb-2 flex items-center justify-between w-[500px] p-4 rounded-lg bg-green-100 border border-green-400 text-green-800 font-semibold text-center z-50 transition-opacity duration-300">
                    {{ session('success') }}
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const alert = document.getElementById('success-alert');
                        if (alert) {
                            setTimeout(() => {
                                alert.style.opacity = '0';
                                setTimeout(() => alert.remove(), 300);
                            }, 1000);
                        }
                    });
                </script>
            @endif
            <form action="{{ route('dashboard.course.course_students.store', $course) }}" id="add-student" class="mx-[70px] mt-[30px] flex flex-col gap-5" method="POST">
                @csrf
                
                <h2 class="font-bold text-2xl">Add New Student</h2>
                <div class="flex flex-col gap-[10px]">
                    <p class="font-semibold">Email Address</p>
                    <div
                        class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] focus-within:border-2 focus-within:border-[#0A090B]">
                        <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                            <img src="{{asset('images/icons/sms.svg')}}" class="h-full w-full object-contain" alt="icon">
                        </div>
                        <input type="text"
                            class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                            placeholder="Write student email address" name="email">
                    </div>
                </div>
                <button type="submit"
                    class="w-[500px] h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">
                    Add Student</button>
            </form>
        </div>
    </section>

</body>

</html>