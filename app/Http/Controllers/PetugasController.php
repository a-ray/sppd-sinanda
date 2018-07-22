<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pegawai;
use Response;

class PetugasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $redirectTo = '/pegawai/pegawai';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::paginate(10);
        return view('pegawai/data-pegawai/index', ['pegawai' => $pegawai]);
    }

     public function create()
    {
        $jabatan = DB::table('jabatan')
        ->get();
        $pangkat = DB::table('pangkat')
        ->get();
        return view('pegawai/data-pegawai/create', ['jabatan' => $jabatan, 'pangkat' => $pangkat]);
    }

    public function store(Request $request)
    {
        $this->validateInput($request);
        $keys = ['nama', 'nip', 'pangkat', 'jabatan', 'tingkat'];
        $input = $this->createQueryInput($keys, $request);
        DB::table('pegawai')
        ->insert($input);

        return redirect()->intended('/pegawai/pegawai');
    }

    public function edit($id)
    {
        $jabatan = DB::table('jabatan')
        ->get();
        $pangkat = DB::table('pangkat')
        ->get();
        $pegawai = DB::table('pegawai') //TANDAI
        ->find($id);
        if ($pegawai == null || count($pegawai) == 0) {
            return redirect()->intended('/pegawai/pegawai');
        }
        return view('pegawai/data-pegawai/edit', ['pegawai' => $pegawai, 'jabatan' => $jabatan, 'pangkat' => $pangkat]);
    }

    public function update(Request $request, $id)
    {
        $pegawai = DB::table('pegawai')
        ->find($id);
        $this->validateInput($request);
        $keys = ['nama', 'nip', 'pangkat', 'jabatan', 'tingkat'];
        $input = $this->createQueryInput($keys, $request);
        DB::table('pegawai')
        ->where('id', $id)
        ->update($input);

        return redirect()->intended('/pegawai/pegawai');
    }

    public function destroy($id)
    {
         DB::table('pegawai')
         ->where('id', $id)
         ->delete();
         return redirect()->intended('/pegawai/pegawai');
    }

    public function search(Request $request) {

        $constraints = [
            'pangkat' => $request['pangkat'],
            'jabatan' => $request['jabatan'],
            'nama' => $request['nama']
            ];

       $pegawai = $this->doSearchingQuery($constraints);
       return view('pegawai/data-pegawai/index', ['pegawai' => $pegawai, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Pegawai::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }
            $index++;
        }
        return $query->paginate(10);
    }

    private function validateInput($request) {
        $this->validate($request, [
            'nama' => 'required|max:60',
            'nip' => 'required|max:30',
            'pangkat' => 'required|max:60',
            'jabatan' => 'required|max:100',
            'tingkat' => 'required|max:2'
        ]);
    }

    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }
}
