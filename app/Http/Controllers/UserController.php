<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
       $data['dataUser'] = User::paginate(10); 
    return view('admin.user.index', $data);
}

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['name']     = $request->name;
        $data['email']    = $request->email;
        $data['password'] = Hash::make($request->password);

        // Store profile picture if exists
        if ($request->hasFile('profile_picture')) {
            $path                    = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data User Berhasil!');
    }

    public function show(string $id)
    {
        $data['user'] = User::findOrFail($id);
        return view('admin.user.show', $data);
    }

    public function edit(string $id)
    {
        $data['user'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $id,
            'password'        => 'nullable|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // nullable, bukan required
        ]);

        // Update data dasar
        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Upload file JIKA ADA
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            // Hapus file lama jika ada
            if ($user->profile_picture) {
                $oldImagePath = public_path('assets/img/' . $user->profile_picture);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Generate nama file
            $filename = 'user_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Simpan file
            $file->move(public_path('assets/img'), $filename);

            // Update database
            $user->profile_picture = $filename;
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Update Data User Berhasil!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Delete profile picture if exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data User Berhasil Dihapus!');
    }

    /**
     * Delete profile picture
     */
    public function destroyProfilePicture(string $id)
    {$user = User::findOrFail($id);

        if ($user->profile_picture) {
            $imagePath = public_path('assets/img/' . $user->profile_picture);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $user->profile_picture = null;
            $user->save();

            return redirect()->route('user.edit', $id)->with('success', 'Foto profil berhasil dihapus!');
        }

        return redirect()->route('user.edit', $id)->with('error', 'Tidak ada foto profil untuk dihapus!');}
}
