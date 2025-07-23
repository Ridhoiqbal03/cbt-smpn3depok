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
    <section id="signup" class="flex w-full min-h-screen relative flex-col lg:flex-row">
        <!-- Navigation -->
        <nav class="flex items-center px-4 sm:px-6 lg:px-[50px] pt-4 sm:pt-6 lg:pt-[30px] w-full absolute top-0 z-10">
            <div class="flex items-center">
                <a href="index.html">
                    <img src="{{asset('images/logo/logo-31.png')}}" alt="logo" class="h-8 sm:h-10 lg:h-auto">
                </a>
            </div>
            <div class="flex items-center justify-end w-full">
                <ul class="flex items-center gap-4 sm:gap-6 lg:gap-[30px]">
                    <li class="h-10 sm:h-12 lg:h-[52px] flex items-center">
                        <a href="{{ route('register') }}"
                            class="font-semibold text-white px-4 sm:px-6 lg:p-[14px_30px] py-2 sm:py-3 lg:py-[14px] bg-[#0A090B] rounded-full text-center text-sm sm:text-base">Register
                            </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <!-- Left Side - Form -->
        <div class="left-side min-h-screen flex flex-col w-full pb-6 sm:pb-8 lg:pb-[30px] pt-16 sm:pt-20 lg:pt-[82px] px-4 sm:px-6 lg:px-0">
            <div class="h-full w-full flex items-center justify-center">
                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6 sm:gap-8 lg:gap-[30px] w-full max-w-[450px] shrink-0">
                @csrf    
                <h1 class="font-bold text-xl sm:text-2xl leading-7 sm:leading-9 text-center lg:text-left">Log In</h1>
                    <div class="flex flex-col gap-2">
                        <p class="font-semibold text-sm sm:text-base">Email Address</p>
                        <div
                            class="flex items-center w-full h-12 sm:h-[52px] p-3 sm:p-[14px_16px] rounded-full border {{ $errors->has('email') ? 'border-red-500' : 'border-[#EEEEEE]' }} focus-within:border-2 focus-within:border-[#0A090B]">
                            <div class="mr-3 sm:mr-[14px] w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center overflow-hidden">
                                <img src="{{asset('images/icons/sms.svg')}}" class="h-full w-full object-contain" alt="icon">
                            </div>
                            <input type="email"
                                class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none text-sm sm:text-base"
                                placeholder="Write your correct input here" name="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="font-semibold text-sm sm:text-base">Password</p>
                        <div
                            class="flex items-center w-full h-12 sm:h-[52px] p-3 sm:p-[14px_16px] rounded-full border {{ $errors->has('password') ? 'border-red-500' : 'border-[#EEEEEE]' }} focus-within:border-2 focus-within:border-[#0A090B]">
                            <div class="mr-3 sm:mr-[14px] w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center overflow-hidden">
                                <img src="{{asset('images/icons/lock.svg')}}" class="h-full w-full object-contain" alt="icon">
                            </div>
                            <input type="password"
                                class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none text-sm sm:text-base"
                                placeholder="Write your correct input here" name="password">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full h-12 sm:h-[52px] p-3 sm:p-[14px_30px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center text-sm sm:text-base">Sign
                        In to my Account</button>
                </form>
            </div>
        </div>
        
        <!-- Right Side - Illustration -->
        <div class="right-side min-h-screen flex flex-col w-full lg:w-[650px] shrink-0 pb-6 sm:pb-8 lg:pb-[30px] pt-16 sm:pt-20 lg:pt-[82px] bg-[#6436F1] px-4 sm:px-6 lg:px-0">
            <div class="h-full w-full flex flex-col items-center justify-center pt-8 sm:pt-12 lg:pt-[66px] gap-8 sm:gap-12 lg:gap-[100px]">
                <div class="w-full max-w-[500px] h-48 sm:h-64 lg:h-[360px] flex shrink-0 overflow-hidden">
                    <img src="{{asset('images/thumbnail/sign-in-illustration.png')}}" class="w-full h-full object-contain"
                        alt="banner">
                </div>
                
                <!-- Logo Slider - Hidden on mobile, visible on tablet and up -->
                <div class="logos w-full overflow-hidden hidden sm:block">
                    <div class="group/slider flex flex-nowrap w-max items-center">
                        <div
                            class="logo-container animate-[slide_15s_linear_infinite] group-hover/slider:pause-animate flex gap-6 sm:gap-8 lg:gap-10 pl-6 sm:pl-8 lg:pl-10 items-center flex-nowrap">
                            <div class="w-fit flex shrink-0">
                                <img src="{{asset('images/logo/logo-51.svg')}}" alt="logo" class="h-8 sm:h-10 lg:h-auto">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{asset('images/logo/logo-51-1.svg')}}" alt="logo" class="h-8 sm:h-10 lg:h-auto">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{asset('images/logo/logo-52.svg')}}" alt="logo" class="h-8 sm:h-10 lg:h-auto">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{asset('images/logo/logo-52-1.svg')}}" alt="logo" class="h-8 sm:h-10 lg:h-auto">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{asset('images/logo/logo-51.svg')}}" alt="logo" class="h-8 sm:h-10 lg:h-auto">
                            </div>
                        </div>
                        <div
                            class="logo-container animate-[slide_15s_linear_infinite] group-hover/slider:pause-animate flex gap-6 sm:gap-8 lg:gap-10 pl-6 sm:pl-8 lg:pl-10 items-center flex-nowrap">
                            <div class="w-fit flex shrink-0">
                                <img src="{{asset('images/logo/logo-51.svg')}}" alt="logo" class="h-8 sm:h-10 lg:h-auto">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{asset('images/logo/logo-51-1.svg')}}" alt="logo" class="h-8 sm:h-10 lg:h-auto">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{asset('images/logo/logo-52.svg')}}" alt="logo" class="h-8 sm:h-10 lg:h-auto">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{asset('images/logo/logo-52-1.svg')}}" alt="logo" class="h-8 sm:h-10 lg:h-auto">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{asset('images/logo/logo-51.svg')}}" alt="logo" class="h-8 sm:h-10 lg:h-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>