<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use League\HTMLToMarkdown\HtmlConverter;
use PDF;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = [
            'title' => "Console"
        ];
        return view('home', $data);
    }
    public function listUser()
    {
        $user = User::all();

        $data = [
            'title' => 'List User',
            'data' => $user
        ];

        return view('user/list', $data);
    }
    public function addUser()
    {
        $data = [
            'title' => 'Add User',
        ];

        return view('user/add', $data);
    }
    public function delUser($id)
    {
        User::where('id', $id)->delete();
        Session::flash('message', 'User Deleted Successfully');
        return redirect('/home/user');
    }
    public function editUser(Request $request)
    {
        User::where('id', $request->id)->update([
            'password' => Hash::make($request->password)
        ]);
        Session::flash('message', 'Password Changed Successfully');
        return redirect('/home/user');
    }
    public function company()
    {
        $company = $this->request->session()->get('company');
        return $company;
    }
    public function docsMan(Request $request)
    {
        $listFiles = Folder::all();
        $data = [
            'title' => 'Docs Manager',
            'data' => $listFiles
        ];

        if ($request->go) {
            $getFiles = Storage::disk('docs')->files($request->go . '/1.0');
            foreach ($getFiles as $g) {
                $fileName = explode('/', $g);
                $file[] = $fileName[2];
            }
            $data = [
                'title' => 'Docs Manager',
                'data' => $getFiles,
                'file' => $file,
                'folder' => $request->go,
            ];
            return view('docs/listFiles', $data);
        }
        return view('docs/listParent', $data);
    }
    public function create(Request $request)
    {
        $template = Storage::disk('docs')->get('master/1.0/overview');
        $data = [
            'title' => $request->parent,
            'template' => $template,
        ];
        return view('docs/create', $data);
    }
    public function createDocs(Request $request)
    {
        Storage::disk('docs')->put($request->parent . '/1.0/' . $request->title, $request->content);
        $content = Storage::disk('docs')->get($request->parent . '/1.0/' . $request->title);
        $convert = new HtmlConverter();
        $convert->getConfig()->setOption('hard_break', false);
        $markdown = $convert->convert($content);
        Storage::disk('docs')->put($request->parent . '/1.0/rendered/' . $request->title . '.md', $markdown);
        Session::flash('message', $request->title . ' Created Succesfully');
        return redirect('/home/docsman?go=' . $request->parent);
    }
    public function addParentDocs()
    {
        $data = [
            'title' => 'Create Parent Docs'
        ];

        return view('docs/addParent', $data);
    }
    public function actionAddParent(Request $request)
    {
        Folder::create([
            'folder' => $request->company,
        ]);
        Storage::disk('docs')->makeDirectory($request->company . '/1.0/rendered');
        Storage::disk('docs')->copy('master/1.0/index', $request->company . '/1.0/index');
        Storage::disk('docs')->copy('master/1.0/overview', $request->company . '/1.0/overview');
        Storage::disk('docs')->copy('master/1.0/rendered/index.md', $request->company . '/1.0/rendered/index.md');
        Storage::disk('docs')->copy('master/1.0/rendered/overview.md', $request->company . '/1.0/rendered/overview.md');
        Session::flash('message', 'Parent Successfully Added');
        return redirect('/home/docsman');
    }
    public function editor(Request $request)
    {
        $getFileContent = "";
        if ($request->url) {
            $getFileContent = Storage::disk('docs')->get($request->url);
            $getFileName = basename($request->url);
        }
        $data = [
            'title' => $request->url,
            'fileContent' => $getFileContent,
            'fileName' => $getFileName,
        ];
        return view('docs/editor', $data);
    }
    public function saveDocs(Request $request)
    {
        Storage::disk('docs')->delete($request->url);
        $folderArray = explode('/', $request->url);
        $folder = $folderArray[0] . '/' . $folderArray[1];
        $newFileName = $folder . '/' . $request->title;
        Storage::disk('docs')->put($newFileName, $request->content);
        $content = Storage::disk('docs')->get($newFileName);
        Storage::disk('docs')->delete($folder . '/rendered/' . $folderArray[2] . '.md');
        $convert = new HtmlConverter();
        $convert->getConfig()->setOption('hard_break', false);
        $markdown = $convert->convert($content);
        Storage::disk('docs')->put($folder . '/rendered/' . $request->title . '.md', $markdown);
        Session::flash('message', 'Save Succesful');
        return redirect('/home/docs/editor?url=' . $newFileName);
    }
    public function removeParent($id)
    {
        $getFolder =  Folder::where('id', $id)->get();
        $folder = '';
        foreach ($getFolder as $g) {
            $folder = $g->folder;
        }
        Storage::disk('docs')->deleteDirectory($folder);
        Folder::destroy($id);
        Session::flash('message', 'Parent Successfully Removed');
        return redirect('/home/docsman');
    }
    public function editParent(Request $request)
    {
        $getFolder = Folder::where('id', $request->id)->get();
        $folder = '';
        foreach ($getFolder as $g) {
            $folder = $g->folder;
        }
        rename('../resources/docs/' . $folder, '../resources/docs/' . $request->company);
        Folder::where('id', $request->id)->update([
            'folder' => $request->company
        ]);
        Session::flash('message', $folder . 'name successfully changed');
        return redirect('home/docsman');
    }
    public function delFile(Request $request)
    {
        Storage::disk('docs')->delete($request->path);
        Session::flash('message',  $request->path . ' is Successfully deleted');
        return redirect(url()->previous());
    }

    public function downloadPdf()
    {
        $company = Auth::user()->company;
        $files = Storage::disk('docs')->files($company .'/1.0');
        $docs = '';
        foreach($files as $f){
            $docs .= Storage::disk('docs')->get($f);
        }

        $pdf = PDF::loadHTML($docs);
        return $pdf->download($company.' - Grapiku Docs.pdf');

    }
}
