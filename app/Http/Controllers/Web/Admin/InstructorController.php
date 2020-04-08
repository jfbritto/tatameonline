<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Arisharyanto\Laracrop\Laracrop;
use Intervention\Image\Facades\Image;
use App\Services\StudentService;

class InstructorController extends Controller
{
    public function index()
    {
        return view('admin.instructor.home');
    }

    public function create()
    {
        return view('admin.instructor.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        return view('admin.instructor.show', ['instructor' => $user]);
    }

    public function edit(User $user)
    {
        return view('admin.instructor.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function editAvatar(Request $request)
    {
        $dataValid = $request->validate([
            'id_user_avatar' => 'required',
            'avatar' => 'required|',
            'idAcademy_avatar' => 'required',
        ]);

        $user = User::where('id', '=', $request->id_user_avatar)->first();

        $nameFile = $user->avatar;
        if ( $request->hasfile('avatar') && $request->file('avatar')->isValid() ) {
            $nameFile = Laracrop::cropImage($request->input('avatar'));

            if($user->avatar != null && $user->avatar != '')
                Storage::delete("users/{$user->avatar}");

            Image::make(public_path("filetmp/{$nameFile}"))->resize(200, 200)->save(storage_path("app/public/users/{$nameFile}"));

            $user->update(['avatar' => $nameFile]);

            Laracrop::cleanCropTemp();


        }else{
        }

        return redirect('admin/student');
    }
}
