<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\index\IndexTeacherStudentRequest;
use App\Http\Resources\Admin\detail\DetailTeacherStudentResource;
use App\Services\TeacherStudentService;

class TeacherStudentController extends Controller
{
    protected $teacherStudentService;

    public function __construct(TeacherStudentService $teacherStudentService)
    {
        $this->teacherStudentService = $teacherStudentService;

        // contoh middleware (optional)
        // $this->middleware(['permission:view students'])->only('index');
    }

    /**
     * Display list of students assigned to a specific teacher.
     */
    public function index(Request $request, $teacherId)
    {
        $search = $request->query('search');

        $data = $this->teacherStudentService->getStudentsByTeacher($teacherId, $search);

        if (!$data) {
            return $this->teacherStudentService->error('Teacher not found', 404);
        }
        return $this->teacherStudentService->success($data);
    }
}


