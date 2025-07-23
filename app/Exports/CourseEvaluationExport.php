<?php

namespace App\Exports;

use App\Models\Course;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CourseEvaluationExport implements FromView
{
    protected $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function view(): View
    {
        $course = $this->course;

        // Ambil data siswa dengan relasi studentAnswers
        $students = $course->students()->with(['studentAnswers' => function ($q) use ($course) {
            $q->whereIn('course_question_id', $course->questions->pluck('id'));
        }])->get();

        // Ambil semua soal
        $questions = $course->questions;

        // Total soal
        $totalQuestions = $questions->count();

        // Persiapkan data hasil
        $results = [];

        foreach ($students as $student) {
            // Hitung jawaban benar
            $correctAnswersCount = $student->studentAnswers->filter(function ($answer) {
                return $answer->selectedAnswer && $answer->selectedAnswer->is_correct;
            })->count();

            // Hitung skor
            $score = $totalQuestions > 0 ? round(($correctAnswersCount / $totalQuestions) * 100) : 0;

            // Tentukan grade
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
                'student' => $student,
                'correctAnswers' => $correctAnswersCount,
                'score' => $score,
                'grade' => $grade,
                'passed' => $score >= 60
            ];
        }

        return view('admin.courses.course_evaluation', compact(
            'course',
            'students',
            'questions',
            'totalQuestions',
            'results'
        ));
    }
}