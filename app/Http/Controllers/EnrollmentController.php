<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use App\Services\PaymentService;

class EnrollmentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index(Request $request)
    {
        $query = Enrollment::query();

        if ($request->has('search')) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        return $query->with('student', 'course')->get();
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id'
        ]);

        $student = Student::findOrFail($validated['student_id']);
        $course = Course::findOrFail($validated['course_id']);

        /*
        $customer = [
            'external_id' => (string) $student->id,
            'name' => $student->name,
            'email' => $student->email,
            'type' => 'individual',
            'country' => 'br',
            'documents' => [
                [
                    'type' => 'cpf',
                    'number' => '00000000000'
                ]
            ],
            'phone_numbers' => ['+5511999999999'],
            'birthday' => '1990-01-01'
        ];

        $billing = [
            'name' => $student->name,
            'address' => [
                'country' => 'br',
                'state' => 'sp',
                'city' => 'Sao Paulo',
                'neighborhood' => 'Vila Madalena',
                'street' => 'Rua dos Bobos',
                'street_number' => '0',
                'zipcode' => '01234567'
            ]
        ];

        $items = [
            [
                'id' => (string) $course->id,
                'title' => $course->name,
                'unit_price' => $course->price * 100,
                'quantity' => 1,
                'tangible' => false
            ]
        ];

        $transaction = $this->paymentService->charge($course->price * 100, 'credit_card', $validated['card_hash'], $customer, $billing, $items);
        */

        $enrollment = Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
//            'payment_status' => $transaction->status, no modo "real"
            'payment_status' => 1
        ]);

        return response()->json($enrollment, 201);
    }
}
