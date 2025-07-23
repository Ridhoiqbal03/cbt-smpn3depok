<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0A090B] min-h-screen flex flex-col">

<section id="content" class="flex-1 flex flex-col">

    <!-- Header -->
    <div class="border-b border-[#EEEEEE] shrink-0">
        <div class="flex items-center w-full max-w-[1280px] mx-auto justify-between p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 flex shrink-0 overflow-hidden rounded-full">
                    <img src="{{ Storage::url($course->cover) }}" class="object-cover w-full h-full" alt="thumbnail">
                </div>
                <div class="flex flex-col gap-[2px]">
                    <p class="font-bold text-base sm:text-lg">{{ $course->name }}</p>
                    <p class="text-[#7F8190] text-sm">Beginners</p>
                </div>
            </div>
            <div class="flex gap-3 items-center">
                <div class="flex flex-col text-right">
                    <p class="text-sm text-[#7F8190]">Howdy</p>
                    <p class="font-semibold text-sm sm:text-base">{{ Auth::user()->name }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12">
                    <img src="{{ asset('images/photos/default-photo.svg') }}" 
                    alt="photo" class="w-full h-full object-cover rounded-full">
                </div>
            </div>
        </div>
    </div>

    <!-- Timer Tetap Terlihat -->
    <div class="flex justify-center mt-3 px-4">
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded-full shadow-sm text-base sm:text-lg font-semibold flex items-center gap-2">
            <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Waktu Tersisa: <span id="timer">--:--</span>
        </div>
    </div>

    <!-- Tombol Mulai -->
    <div id="start-screen" class="flex items-center justify-center flex-1 px-4">
        <button onclick="startExam()" id="start-button" class="bg-indigo-600 text-white 
        px-6 py-3 rounded-full font-bold text-lg hover:bg-indigo-700 transition">
            Lihat Soal
        </button>
    </div>

    <!-- Konten Ujian -->
    <div id="exam-screen" class="hidden flex-1 flex-col overflow-y-auto px-4">

        <!-- Progress -->
        <div class="text-center mt-4 text-gray-600 text-sm font-medium">
            Soal ke {{ $questionNumber }} / {{ $totalQuestions }}
        </div>
        <div class="w-full max-w-sm mx-auto mt-2 h-3 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full bg-indigo-600 transition-all duration-300" style="width: {{ ($questionNumber / $totalQuestions) * 100 }}%"></div>
        </div>

        <!-- Navigasi Soal -->
        <div class="flex flex-wrap justify-center gap-2 mt-6">
            @foreach($allQuestions as $index => $q)
                <a href="{{ route('dashboard.learning.course', ['course' => $course->id, 'question' => $q->id]) }}"
                class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-full border 
                {{ $q->id == $question->id ? 'bg-indigo-600 text-white' : 'bg-white text-gray-800 border-gray-300 hover:bg-indigo-100' }} 
                font-semibold transition text-sm sm:text-base">
                    {{ $index + 1 }}
                </a>
            @endforeach
        </div>

        <!-- Soal & Jawaban -->
        <form id="exam-form" action="{{ route('dashboard.learning.course.answer.store', ['course'=> $course->id, 'question' =>  $question->id]) }}" 
        method="POST" class="flex flex-col gap-10 items-center mt-10 w-full pb-10">
            @csrf
            <h1 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-center leading-snug px-2 max-w-3xl">
                {{ $question->question }}
            </h1>    
            <div class="flex flex-col gap-4 max-w-2xl w-full px-2">
                @foreach($question->answers as $answer)
                    <label for="{{ $answer->id }}" class="group flex items-center justify-between rounded-full w-full border 
                        border-[#EEEEEE] px-5 py-4 gap-4 transition-all duration-300 has-[:checked]:border-2 has-[:checked]:border-[#0A090B]">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('images/icons/arrow-circle-right.svg') }}" alt="icon" class="w-5 h-5">
                            <span class="font-semibold text-base sm:text-lg">{{ $answer->answer }}</span>
                        </div>
                        <div class="hidden group-has-[:checked]:block">
                            <img src="{{ asset('images/icons/tick-circle.svg') }}" alt="icon">
                        </div>
                        <input type="radio" name="answer_id" id="{{ $answer->id }}" value="{{ $answer->id }}" class="hidden">
                    </label>
                @endforeach    
            </div>
            <button type="submit" class="px-8 py-3 bg-[#6436F1] rounded-full font-bold text-sm text-white transition-all 
                duration-300 hover:shadow-lg">
                Save & Next Question
            </button>
        </form>
    </div>

</section>

<!-- Lock Screen Overlay -->
<div id="lock-overlay" style="display:none; position:fixed; z-index:9999; inset:0; background:rgba(0,0,0,0.85); color:white; align-items:center; justify-content:center; flex-direction:column; font-size:2rem;">
    <div>Ujian terkunci.<br>Silakan kembali ke layar ujian dan fullscreen.</div>
    <button onclick="requestFullscreenAndHideOverlay()" style="margin-top:2rem; padding:1rem 2rem; font-size:1.2rem; border-radius:1rem; background:#6436F1; color:white;">Kembali ke Ujian</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let isFullscreen = false;

    function startExam() {
        if (!isFullscreen) {
            const el = document.documentElement;
            if (el.requestFullscreen) el.requestFullscreen();
            else if (el.webkitRequestFullscreen) el.webkitRequestFullscreen();
            else if (el.mozRequestFullScreen) el.mozRequestFullScreen();
            else if (el.msRequestFullscreen) el.msRequestFullscreen();
            isFullscreen = true;
            document.querySelector('.border-b').style.display = 'none';
        }
        document.getElementById('start-screen').classList.add('hidden');
        document.getElementById('exam-screen').classList.remove('hidden');
        hideLockOverlay();
    }

    document.addEventListener('fullscreenchange', function() {
        if (!document.fullscreenElement) {
            document.querySelector('.border-b').style.display = 'block';
            showLockOverlay();
        } else {
            hideLockOverlay();
        }
    });

    // Deteksi keluar tab
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState !== 'visible') {
            showLockOverlay();
        }
    });

    function showLockOverlay() {
        document.getElementById('lock-overlay').style.display = 'flex';
    }
    function hideLockOverlay() {
        document.getElementById('lock-overlay').style.display = 'none';
    }
    function requestFullscreenAndHideOverlay() {
        const el = document.documentElement;
        if (el.requestFullscreen) el.requestFullscreen();
        else if (el.webkitRequestFullscreen) el.webkitRequestFullscreen();
        else if (el.mozRequestFullScreen) el.mozRequestFullScreen();
        else if (el.msRequestFullscreen) el.msRequestFullscreen();
        hideLockOverlay();
    }

    // Blokir tombol back, refresh, F5, Ctrl+R, dll
    window.addEventListener('keydown', function(e) {
        if (
            e.key === "F5" ||
            (e.ctrlKey && e.key.toLowerCase() === "r") ||
            (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === "r") ||
            (e.altKey && (e.key === "ArrowLeft" || e.key === "ArrowRight")) ||
            (e.key === "Backspace" && !["INPUT", "TEXTAREA"].includes(document.activeElement.tagName))
        ) {
            e.preventDefault();
        }
    });
    // Blokir klik kanan
    window.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
    // Blokir seleksi teks
    window.addEventListener('selectstart', function(e) {
        e.preventDefault();
    });
    // Blokir copy-paste
    window.addEventListener('copy', function(e) {
        e.preventDefault();
    });
    window.addEventListener('paste', function(e) {
        e.preventDefault();
    });

    const serverStartTime = new Date("{{ \Carbon\Carbon::parse($startTime)->toIso8601String() }}").getTime();
    const examDuration = 120 * 60 * 1000;
    const serverEndTime = serverStartTime + examDuration;

    function updateTimer() {
        const now = new Date().getTime();
        const remaining = serverEndTime - now;

        if (remaining <= 0) {
            clearInterval(timerInterval);
            alert("Waktu habis! Ujian selesai.");
            window.location.href = "{{ route('dashboard.learning.finished.course', ['course' => $course->id]) }}";
        } else {
            const minutes = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remaining % (1000 * 60)) / 1000);
            document.getElementById('timer').innerHTML = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }
    }
    const timerInterval = setInterval(updateTimer, 1000);
    updateTimer();

    function saveAnswers() {
        const selectedAnswer = $('input[name="answer_id"]:checked').val();
        if (!selectedAnswer) return;

        $.ajax({
            url: '{{ route("dashboard.learning.course.answer.store", ["course" => $course->id, "question" => $question->id]) }}',
            method: 'POST',
            data: {
                answer_id: selectedAnswer,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Jawaban disimpan:', response);
            },
            error: function(error) {
                console.error('Gagal menyimpan jawaban:', error);
            }
        });
    }
    setInterval(saveAnswers, 30000);

    window.onload = function() {
        startExam();
    };
</script>

</body>
</html>
