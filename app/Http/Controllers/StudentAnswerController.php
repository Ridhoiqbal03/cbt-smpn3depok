<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAnswer;
use App\Models\CourseQuestion;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException ;

class StudentAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request, Course $course, $question)
{
    // Validasi input
    $validated = $request->validate([
        'answer_id' => 'required|exists:course_answers,id'
    ]);

    DB::beginTransaction();

    try {
        $selectedAnswer = CourseAnswer::find($validated['answer_id']);

        // Cek apakah jawaban sesuai dengan pertanyaan
        if ($selectedAnswer->course_question_id != $question) {
            return response()->json(['error' => 'Jawaban tidak tersedia pada pertanyaan ini'], 400);
        }

        // Tentukan nilai jawaban
        $answerValue = $selectedAnswer->is_correct ? 'correct' : 'wrong';

        // Cek apakah siswa sudah menjawab pertanyaan ini sebelumnya
        $existingAnswer = StudentAnswer::where('user_id', Auth::id())
            ->where('course_question_id', $question)
            ->first();

        if ($existingAnswer) {
            // Jika sudah ada jawaban, perbarui jawaban yang ada
            $existingAnswer->update([
                'course_answer_id' => $selectedAnswer->id,
                'answer' => $answerValue,
            ]);
        } else {
            // Jika belum ada jawaban, buat jawaban baru
            StudentAnswer::create([
                'user_id' => Auth::id(),
                'course_question_id' => $question,
                'course_answer_id' => $selectedAnswer->id,
                'answer' => $answerValue,
            ]);
        }

        DB::commit();

        // Ambil urutan soal acak dari session
        $sessionKeyOrder = 'exam_question_order_course_' . $course->id;
        $questionIds = session($sessionKeyOrder);

        if (!$questionIds || !is_array($questionIds)) {
            return response()->json(['error' => 'Urutan soal tidak ditemukan'], 500);
        }

        // Cari indeks soal saat ini
        $currentIndex = array_search(intval($question), $questionIds);
        if ($currentIndex === false) {
            return response()->json(['error' => 'Soal saat ini tidak ditemukan dalam urutan'], 500);
        }

        // Hitung soal berikutnya berdasarkan urutan acak
        $nextQuestionId = ($currentIndex + 1 < count($questionIds)) ? $questionIds[$currentIndex + 1] : null;

        // Jika permintaan berasal dari AJAX, kembalikan respons JSON
        if ($request->ajax()) {
            return response()->json(['message' => 'Jawaban berhasil disimpan', 'next_question_id' => $nextQuestionId]);
        }

        // Jika tidak, redirect ke pertanyaan berikutnya atau selesai
        if ($nextQuestionId) {
            return redirect()->route('dashboard.learning.course', [
                'course' => $course->id,
                'question' => $nextQuestionId
            ]);
        } else {
            return redirect()->route('dashboard.learning.finished.course', ['course' => $course->id])
                ->with('success', 'Ujian selesai.');
        }
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => 'System error: ' . $e->getMessage()], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(StudentAnswer $studentAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentAnswer $studentAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentAnswer $studentAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentAnswer $studentAnswer)
    {
        //
    }
}
