<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\CourseQuestion;
use App\Models\StudentAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Exports\CourseEvaluationExport;
use Maatwebsite\Excel\Facades\Excel;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        //
        $students = $course->students()->orderBy('id', 'DESc')->get() ;
        $questions = $course->questions()->orderBy('id', 'DESc')->get() ;
        $totalQuestions = $questions->count();

        foreach($students as $student){
            $studentAnswers = StudentAnswer::whereHas('question', function ($query) use ($course){
                $query->where('course_id', $course->id);
            })->where('user_id', $student->id)->get();

            $answerCount = $studentAnswers->count();
            $correctAnswersCount =  $studentAnswers->where('answer', 'correct')->count();

            if($answerCount == 0){
                $student->status = 'Not Started';
            } elseif ($correctAnswersCount < $totalQuestions){
                $student->status = 'Not Passed';
            } elseif ($correctAnswersCount == $totalQuestions){
                $student->status = 'Passed';
        }
    }
        
        return view('admin.students.index',[
            'course' => $course,
            'questions' => $questions,
            'students' => $students,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        //
        $students = $course->students()->orderBy('id', 'DESc')->get() ;
            return view('admin.students.add_student',[
                'course' => $course,
                'students' => $students,

            ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        //
        $request->validate([
            'email' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if(!$user){
            $error = ValidationException::withMessages([
                'system_error' => ['Email Student Tidak Tersedia!'],
            ]);

            throw $error;
        }

        $isEnrolled = $course-> students()->where('user_id',$user->id)->exists();

        if ($isEnrolled){
            $error = ValidationException::withMessages([
                'system_error' => ['Student Sudah Memiliki Hak Akses Kelas'],
            ]);

            throw $error;
        }

        DB::beginTransaction();

        try{
            $course->students()->attach($user->id);
            DB::commit();
            return redirect()->route('dashboard.course.course_students.index', $course)
                ->with('success', 'Student Berhasil Diundang');
        }
        catch(\Exception $e){
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }

    public function result(Course $course)
    {
        // Ambil semua siswa yang mengikuti course ini
        $students = CourseStudent::where('course_id', $course->id)
            ->with('user') // relasi ke tabel users
            ->get();

        // Total soal dalam course ini
        $totalQuestions = CourseQuestion::where('course_id', $course->id)->count();

        // Data nilai per siswa
        $results = [];

        foreach ($students as $student) {
            // Ambil semua jawaban siswa tersebut untuk course ini
            $studentAnswers = StudentAnswer::with('question', 'selectedAnswer')
                ->where('user_id', $student->user_id)
                ->whereHas('question', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })
                ->get();

            // Hitung jawaban yang benar berdasarkan relasi course_answer dan student_answer
            $correctAnswersCount = 0;
            foreach ($studentAnswers as $answer) {
                if ($answer->selectedAnswer && $answer->selectedAnswer->is_correct) {
                    $correctAnswersCount++;
                }
            }

            $score = $totalQuestions > 0 ? round(($correctAnswersCount / $totalQuestions) * 100) : 0;

            $grade = 'F';
            if ($score >= 85) {
                $grade = 'A';
            } elseif ($score >= 70) {
                $grade = 'B';
            } elseif ($score >= 60) {
                $grade = 'C';
            } elseif ($score >= 50) {
                $grade = 'D';
            }

            $results[] = [
                'student' => $student->user,
                'correctAnswers' => $correctAnswersCount,
                'score' => $score,
                'grade' => $grade,
                'passed' => $score >= 60 // contoh lulus jika >= C
            ];
        }

        return view('admin.courses.result', [
            'course' => $course,
            'totalQuestions' => $totalQuestions,
            'results' => $results
        ]);
    }

    public function export($id)
    {
        $course = Course::with(['questions.answers', 'students.studentAnswers'])->findOrFail($id);
        return Excel::download(new CourseEvaluationExport($course), 'evaluasi_' . $course->name . '.xlsx');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseStudent $courseStudent)
    {
        //
    }
}
