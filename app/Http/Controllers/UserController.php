<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users  = User::where('is_admin', 0)->get();
        $total  = User::where('is_admin', 0)->count();

        $present        = User::where('is_admin', 0)->where('invitation_status', 1)->count();
        $not_present    = User::where('is_admin', 0)->where('invitation_status', 0)->count();

        return view('admin.users', compact('users', 'total', 'present', 'not_present'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function randomChar($n)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ceknumber  = User::where('invitation_number', $request->invitation_number)->count();
        $cekemail   = User::where('email', $request->email)->count();
        $invitation_code    = $this->randomChar(10);

        if ($ceknumber > 0) {
            return redirect()->back()->with('errors', 'Invitation Number has been used by another users');
        }
        if ($cekemail > 0) {
            return redirect()->back()->with('errors', 'Email has been used by another users');
        }

        DB::beginTransaction();

        try {
            $qrCodePath = 'invitation/' . $invitation_code . '.png';
            $fullPath = storage_path('app/public/' . $qrCodePath);
            $realPath   = env('APP_URL') . '/invitation/' . $invitation_code;

            // Cek apakah folder qrcodes sudah ada, jika belum buat folder tersebut
            if (!file_exists(dirname($fullPath))) {
                mkdir(dirname($fullPath), 0755, true);
            }

            // QrCode::format('png')->size(200)->generate($invitation_code, $fullPath);

            $qrCode = file_get_contents("https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . $realPath);
            file_put_contents($fullPath, $qrCode);
            // return response()->download(public_path('qrcode.png'));

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt('Emas999'),
                'avatar' => 'avatar-1.jpg',
                'city' => $request->city,
                'invitation_number' => $request->invitation_number,
                'invitation_type' => $request->invitation_type,
                'invitation_status' => $request->invitation_status,
                'invitation_code' => $invitation_code,
                'invitation_qr' => $invitation_code . '.png',
                'invitation_link' => $realPath

            ]);

            DB::commit();
            return redirect()->back()->with('success', 'User has been created successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('errors', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('id', $request->id)->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'is_admin' => $request->is_admin,
            'invitation_type' => $request->invitation_type,
            'invitation_status' => $request->invitation_status
        ]);
        return redirect()->back()->with('success', 'User has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $user = User::where('id', $request->id)->first();

        $user->delete();

        return redirect()->back()->with('success', 'User has been deleted successfully!');
    }
}
