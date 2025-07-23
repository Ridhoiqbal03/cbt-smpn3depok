<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseQuestion;
use App\Models\StudentAnswer;
use Auth;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    //

    public function index(){

        $user = Auth::user();
        $my_courses = $user->courses()->with('category')->orderBy('id','DESC')->get();

        foreach($my_courses as $course){
            $totalQuestionsCount = $course->questions()->count();

            $answeredQuestionsCount = StudentAnswer::where('user_id', $user->id)->
            whereHas('question', function ($query) use ($course) {
                $query->where('course_id', $course->id);
            })->distinct()->count('course_question_id');

            // Cek apakah ujian sudah selesai
            if($answeredQuestionsCount >= $totalQuestionsCount){
                $course->nextQuestionId = null;
                $course->examStatus = 'completed';
            } else {
                // Cek apakah ada ujian yang sedang berlangsung
                $sessionKey = "exam_timer_{$course->id}_{$user->id}";
                $examStartTime = session($sessionKey);
                
                if ($examStartTime) {
                    $examDuration = 120; // menit
                    $examEndTime = $examStartTime->addMinutes($examDuration);
                    $now = now();
                    $timeRemaining = $examEndTime->diffInSeconds($now);
                    
                    if ($timeRemaining <= 0) {
                        // Ujian sudah habis, auto-save dan hapus session
                        $this->autoSaveUnansweredQuestions($course, $user);
                        session()->forget($sessionKey);
                        $course->nextQuestionId = null;
                        $course->examStatus = 'expired';
                    } else {
                        // Ujian masih berlangsung
                        $firstUnansweredQuestion = CourseQuestion::where('course_id', $course->id)->
                        whereNotIn('id', function($query) use ($user){
                            $query->select('course_question_id')-> from('student_answers')->
                            where('user_id', $user->id);
                        })->orderBy('id', 'asc')->first();

                        $course->nextQuestionId = $firstUnansweredQuestion ? $firstUnansweredQuestion->id : null;
                        $course->examStatus = 'in_progress';
                        $course->timeRemaining = $timeRemaining;
                    }
                } else {
                    // Belum mulai ujian
                    $firstUnansweredQuestion = CourseQuestion::where('course_id', $course->id)->
                    whereNotIn('id', function($query) use ($user){
                        $query->select('course_question_id')-> from('student_answers')->
                        where('user_id', $user->id);
                    })->orderBy('id', 'asc')->first();

                    $course->nextQuestionId = $firstUnansweredQuestion ? $firstUnansweredQuestion->id : null;
                    $course->examStatus = 'not_started';
                }
            }
        }
        
        return view('student.courses.index',[
            'my_courses' => $my_courses,
        ]);
    }

public function learning(Course $course, $question)
{
    $user = Auth::user();

    if (!$user->courses()->where('course_id', $course->id)->exists()) {
        abort(404, 'Anda tidak terdaftar pada course ini.');
    }

    $sessionKeyTime = 'exam_start_time_course_' . $course->id;
    $sessionKeyOrder = 'exam_question_order_course_' . $course->id;
    $sessionKeyStarted = 'exam_started_course_' . $course->id;

    if (!session()->has($sessionKeyTime)) {
        session([$sessionKeyTime => now()]);
    }

    if (!session()->has($sessionKeyOrder)) {
        $questionIds = CourseQuestion::where('course_id', $course->id)
            ->pluck('id')
            ->shuffle()
            ->values()
            ->toArray();

        if (empty($questionIds)) {
            abort(404, 'Tidak ada soal di course ini.');
        }

        session([$sessionKeyOrder => $questionIds]);
    } else {
        $questionIds = session($sessionKeyOrder);
    }

    if (!session()->has($sessionKeyStarted)) {
        session([$sessionKeyStarted => true]);
        $firstQuestionId = $questionIds[0];
        return redirect()->route('dashboard.learning.course', [
            'course' => $course->id,
            'question' => $firstQuestionId
        ]);
    }

    $currentIndex = array_search(intval($question), $questionIds);
    if ($currentIndex === false) {
        abort(404, 'Soal tidak ditemukan dalam urutan.');
    }

    $currentQuestion = CourseQuestion::where('course_id', $course->id)
        ->where('id', intval($question))
        ->firstOrFail();

    $totalQuestions = count($questionIds);

    $allQuestions = CourseQuestion::whereIn('id', $questionIds)
        ->orderByRaw("FIELD(id, " . implode(',', $questionIds) . ")")
        ->get();

    // Ambil jawaban yang sudah disimpan oleh pengguna untuk soal ini
    $userAnswer = StudentAnswer::where('user_id', Auth::id())
        ->where('course_question_id', $question)
        ->first();

    $nextQuestionId = ($currentIndex + 1 < $totalQuestions) ? $questionIds[$currentIndex + 1] : null;

    return view('student.courses.learning', [
        'course' => $course,
        'question' => $currentQuestion,
        'questionNumber' => $currentIndex + 1,
        'totalQuestions' => $totalQuestions,
        'allQuestions' => $allQuestions,
        'nextQuestionId' => $nextQuestionId,
        'startTime' => session($sessionKeyTime),
        'userAnswer' => $userAnswer, // Tambahkan data jawaban pengguna
    ]);
}
    public function learning_finished(Course $course){

        return view('student.courses.learning_finished',[
            'course' => $course,

        ]);

    }

    public function learning_rapport(Course $course){

        $userId = Auth::id();

        $studentAnswers = StudentAnswer::with([
            'question.answers',         // semua pilihan jawaban dari soal
            'question',                 // soal
            'selectedAnswer'            // jawaban yang dipilih siswa
        ])
        ->whereHas('question', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })
        ->where('user_id', $userId)
        ->get();

        $totalQuestions = CourseQuestion::where('course_id', $course->id)->count();
        $correctAnswersCount =  $studentAnswers->where('answer', 'correct')->count();
        $passed = $correctAnswersCount == $totalQuestions;


        $score = $totalQuestions > 0 ? round(($correctAnswersCount / $totalQuestions) * 100) : 0;

        $grade = 'F';
        if ($score >= 80) {
            $grade = 'A';
        } elseif ($score >= 70) {
            $grade = 'B';
        } elseif ($score >= 60) {
            $grade = 'C';
        } elseif ($score >= 50) {
            $grade = 'D';
        }
    
        return view('student.courses.learning_rapport',[
            'passed' => $passed,
            'course' => $course,
            'studentAnswers' => $studentAnswers,
            'totalQuestions' => $totalQuestions,
            'correctAnswersCount' => $correctAnswersCount,
            'score' => $score,      // ✅ dikirim ke view
            'grade' => $grade,      // ✅ dikirim ke view
        ]);
    }

    /**
     * Auto-save unanswered questions when exam time expires
     */
    private function autoSaveUnansweredQuestions($course, $user)
    {
        // Ambil semua soal yang belum dijawab
        $unansweredQuestions = CourseQuestion::where('course_id', $course->id)
            ->whereNotIn('id', function($query) use ($user) {
                $query->select('course_question_id')
                    ->from('student_answers')
                    ->where('user_id', $user->id);
            })->get();

        foreach ($unansweredQuestions as $question) {
            // Ambil jawaban pertama (default) atau jawaban acak
            $defaultAnswer = $question->answers()->first();
            
            if ($defaultAnswer) {
                // Simpan jawaban default dengan status 'incorrect'
                StudentAnswer::create([
                    'user_id' => $user->id,
                    'course_question_id' => $question->id,
                    'course_answer_id' => $defaultAnswer->id,
                    'answer' => 'incorrect', // Default incorrect karena tidak dijawab
                ]);
            }
        }
    }

    /**
     * Check exam status and return remaining time
     */
    public function checkExamStatus(Course $course)
    {
        $user = Auth::user();
        $sessionKey = "exam_timer_{$course->id}_{$user->id}";
        $examStartTime = session($sessionKey);
        
        if (!$examStartTime) {
            return response()->json([
                'status' => 'not_started',
                'message' => 'Exam not started'
            ]);
        }

        $examDuration = 120; // menit
        $examEndTime = $examStartTime->addMinutes($examDuration);
        $now = now();
        $timeRemaining = $examEndTime->diffInSeconds($now);

        if ($timeRemaining <= 0) {
            // Auto-save unanswered questions
            $this->autoSaveUnansweredQuestions($course, $user);
            
            // Clear session
            session()->forget($sessionKey);
            
            return response()->json([
                'status' => 'expired',
                'message' => 'Exam time expired',
                'redirect_url' => route('dashboard.learning.finished.course', $course)
            ]);
        }

        return response()->json([
            'status' => 'active',
            'time_remaining' => $timeRemaining,
            'end_time' => $examEndTime->toISOString()
        ]);
    }
}
