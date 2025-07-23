<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="{{asset('css/output.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0A090B]">
    <section id="content" class="flex">
        <div id="sidebar" class="w-[270px] flex flex-col shrink-0 min-h-screen justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB]">
            <div class="w-full flex flex-col gap-[30px]">
                <a href="index.html" class="flex items-center justify-center">
                    <img src="{{asset('images/logo/logo-3.png')}}" alt="logo">
                </a>
                <ul class="flex flex-col gap-3">
                    <li>
                        <h3 class="font-bold text-xs text-[#A5ABB2]">DAILY USE</h3>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{asset('images/icons/home-hashtag.svg')}}" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Overview</p>
                        </a>
                    </li>
                  
                    <li>
                        <a href="{{ route('dashboard.students.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{asset('images/icons/profile-2user.svg')}}" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Students</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.teachers.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{asset('images/icons/profile-2user.svg')}}" alt="icon">
                            </div>
                            <p class="font-semibold text-white transition-all duration-300 hover:text-white">Teacher</p>
                        </a>
                    </li>
                   
                </ul>
                <ul class="flex flex-col gap-3">
                    <li>
                        <h3 class="font-bold text-xs text-[#A5ABB2]">OTHERS</h3>
                    </li>
                    
                    <li>
                        <a href="{{ route('profile.edit') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{asset('images/icons/setting-2.svg')}}" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Settings</p>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    
                    <li>
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                                <div>
                                    <img src="{{asset('images/icons/security-safe.svg')}}" alt="icon">
                                </div>
                                <p class="font-semibold transition-all duration-300 hover:text-white">Logout</p>
                            </button>
                            </form>
                    </li>
                </ul>
            </div>
            
        </div>
        <div id="menu-content" class="flex flex-col w-full pb-[30px]">
            <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
                <form class="search flex items-center w-[400px] h-[52px] p-[10px_16px] rounded-full border border-[#EEEEEE]">  
                <input type="text" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Search by report, teacher, etc" name="search">
                    <button type="submit" class="ml-[10px] w-8 h-8 flex items-center justify-center">
                        <img src="{{asset('images/icons/search.svg')}}" alt="icon">
                    </button>
                </form>
                <div class="flex items-center gap-[30px]">
                    <div class="flex gap-[14px]">
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="{{asset('images/icons/receipt-text.svg')}}" alt="icon">
                        </a>
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
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
                    <a href="{{ route('dashboard.teachers.index') }}" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Manage Teachers</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">New Teacher</a>
                </div>
            </div>
            <div class="header flex flex-col gap-1 px-5 mt-5">
                <h1 class="font-extrabold text-[30px] leading-[45px]">New Teacher</h1>
                <p class="text-[#7F8190]">Provide high quality for best teachers</p>
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
    
            <form method="POST" enctype="multipart/form-data" action="{{ route('dashboard.teachers.store') }}" class="flex flex-col gap-[30px] w-[500px] mx-[70px] mt-10">
            @csrf      

            <!-- Teacher Name -->
            <div class="flex flex-col gap-[10px]">
                <p class="font-semibold">Teacher Name</p>
                <div class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                    <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/icons/profile.svg') }}" class="w-full h-full object-contain" alt="icon">
                    </div>
                    <input type="text" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Write your better teacher name" name="name" required>
                </div>
            </div>

            <!-- Email -->
            <div class="flex flex-col gap-[10px]">
                <label for="email" class="font-semibold">Email</label>
                <div class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                    <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/icons/note-text.svg') }}" class="w-full h-full object-contain" alt="email icon">
                    </div>
                    <input type="email" id="email" name="email" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Enter teacher email" required>
                </div>
            </div>

            <!-- Password -->
            <div class="flex flex-col gap-[10px]">
                <label for="password" class="font-semibold">Password</label>
                <div class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                    <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/icons/security-user.svg') }}" class="w-full h-full object-contain" alt="password icon">
                    </div>
                    <input type="password" id="password" name="password" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Enter teacher password" required>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-5">
                <!-- <a href="" class="w-full h-[52px] p-[14px_20px] bg-[#0A090B] rounded-full font-semibold text-white transition-all duration-300 text-center">Add to Draft</a> -->
                <button type="submit" class="w-full h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">
                    Save Teacher
                </button>
            </div>
        </form>

        </div>
    </section>

    <script>
        function previewFile() {
            var preview = document.querySelector('.file-preview');
            var fileInput = document.querySelector('input[type=file]');

            if (fileInput.files.length > 0) {
                var reader = new FileReader();
                var file = fileInput.files[0]; // Get the first file from the input

                reader.onloadend = function () {
                    var img = preview.querySelector('.thumbnail-icon'); // Get the thumbnail image element
                    img.src = reader.result; // Update src attribute with the uploaded file
                    preview.classList.remove('hidden'); // Remove the 'hidden' class to display the preview
                }

                reader.readAsDataURL(file);
                fileInput.setAttribute('data-empty', 'false');
            } else {
                preview.classList.add('hidden'); // Hide preview if no file selected
                fileInput.setAttribute('data-empty', 'true');
            }
        }
    </script>

    <script>
        function handleActiveAnchor(element) {
            event.preventDefault();

            const group = element.getAttribute('data-group');
            
            // Reset all elements' aria-checked to "false" within the same data-group
            const allElements = document.querySelectorAll(`[data-group="${group}"][aria-checked="true"]`);
            allElements.forEach(el => {
                el.setAttribute('aria-checked', 'false');
            });
            
            // Set the clicked element's aria-checked to "true"
            element.setAttribute('aria-checked', 'true');
        }
    </script>
    
</body>
</html>