<?php

namespace App\Http\Controllers;
use App\Http\Requests\StudentCreateRequest;
use App\Models\Std;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function display()
    {
        $students = Student::all();
        return view('students.display', compact('students'));
    }
    

    public function createForm()
    {
        return view('students.create_form');
    }

public function store(StudentCreateRequest $request)
{
    $teacher = $request->input('teacher');
    $subjects = $request->input('subjects');

    if ($request->has('standard') && $request->has('capacity')) {
        $class = new Std();
        $class->standard = $request->input('standard');
        $class->capacity = $request->input('capacity');
        $class->save();

        foreach ($subjects as $subjectName) {
            $subject = new Subject();
            $subject->teacher = $teacher;
            $subject->subject_name = $subjectName;
            $subject->class_id = $class->id;
            $subject->save();
        }

        return redirect()->route('students.createForm')->with('success', 'Form data processed successfully.');
    } else {
       
        foreach ($subjects as $subjectName) {
            $subject = new Subject();
            $subject->teacher = $teacher;
            $subject->subject_name = $subjectName;
            $subject->save();
        }

        return redirect()->route('students.createForm')->with('success', 'Form data processed successfully.');
    }
}


    


    public function removeSubject($index)
    {
       
        return redirect()
            ->route('students.display')
            ->with('success', 'Subject removed successfully.');
    }
    public function addSubject(Request $request)
    {
        $numberOfSubjects = $request->input('numberOfSubjects');
        $numberOfSubjects += 1;
        return redirect()
            ->route('students.display')
            ->with('numberOfSubjects', $numberOfSubjects);
    }

//     public function edit($id)
// {
//     $student = Student::find($id);
//     if (!$student) {
//         return redirect()->route('students.display')->with('error', 'Student not found.');
//     }

//     return view('students.edit', compact('student'));
// }
// public function update(Request $request, $id)
// {
//     $validatedData = $request->validate([
//         'name' => 'required|string|max:255',
//         'class' => 'required|string|max:255',
//         'roll' => 'required|string|max:255',
//         'subjects.*' => 'nullable|string|max:255',
//         'teacher' => 'required|string|max:255',
//     ]);

//     $student = Student::find($id);
//     if (!$student) {
//         return redirect()->route('students.display')->with('error', 'Student not found.');
//     }
   

//     $student->name = $validatedData['name'];
//     $student->class = $validatedData['class'];
//     $student->roll = $validatedData['roll'];
//     $student->subjects = implode(',', $validatedData['subjects']);
//     $student->teacher = $validatedData['teacher'];
//     $student->save();

//     return redirect()->route('students.display')->with('success', 'Student updated successfully.');
// }
  
  
  
    public function remove($id)
{
    $student = Student::find($id);
    if (!$student) {
        return redirect()->route('students.display')->with('error', 'Student not found.');
    }

    $student->delete();
    return redirect()->route('students.display')->with('success', 'Student deleted successfully.');
}

}
