<?php

namespace App\Http\Controllers;

use App\Models\Docs;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use League\HTMLToMarkdown\HtmlConverter;
use Mpdf\Mpdf;
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
            $parentId = Folder::where('folder', $request->go)->first()->id;
            $getFiles = Docs::where('parent', $parentId)->get();
            //$getFiles = Storage::disk('docs')->files($request->go . '/1.0');
            $file = [];
            foreach ($getFiles as $g) {
                //$fileName = explode('/', $g);
                //$file[] = $fileName[2];
                $file[] = $g->title;
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
        $parentId = Folder::where('folder', $request->parent)->first()->id;
        Docs::create([
            'parent' => $parentId,
            'title' => $request->title,
            'value' => $request->content
        ]);
        // Storage::disk('docs')->put($request->parent . '/1.0/' . $request->title, $request->content);
        // $content = Storage::disk('docs')->get($request->parent . '/1.0/' . $request->title);

        $convert = new HtmlConverter();
        $convert->getConfig()->setOption('hard_break', false);
        $markdown = $convert->convert($request->content);
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
        $parent = Folder::create([
            'folder' => $request->company,
        ]);
        Storage::disk('docs')->makeDirectory($request->company . '/1.0/rendered');
        //Storage::disk('docs')->copy('master/1.0/index', $request->company . '/1.0/index');
        //Storage::disk('docs')->copy('master/1.0/overview', $request->company . '/1.0/overview');
        Docs::create([
            'parent' => $parent->id,
            'title' => 'index',
            'value' => Storage::disk('docs')->get('master/1.0/index')
        ]);
        Docs::create([
            'parent' => $parent->id,
            'title' => 'overview',
            'value' => Storage::disk('docs')->get('master/1.0/overview')
        ]);
        Storage::disk('docs')->copy('master/1.0/rendered/index.md', $request->company . '/1.0/rendered/index.md');
        Storage::disk('docs')->copy('master/1.0/rendered/overview.md', $request->company . '/1.0/rendered/overview.md');
        Session::flash('message', 'Parent Successfully Added');
        return redirect('/home/docsman');
    }
    public function editor(Request $request)
    {
        $getFileContent = "";
        $getFileName = "";
        if ($request->url) {
            $docs = Docs::where('id', $request->url)->first();
            //$getFileContent = Storage::disk('docs')->get($request->url);
            $getFileContent = $docs->value;
            $getFileName = $docs->title;
        }
        $data = [
            'id' => $request->url,
            'title' => $getFileName,
            'fileContent' => $getFileContent,
            'fileName' => $getFileName,
        ];
        return view('docs/editor', $data);
    }
    public function saveDocs(Request $request)
    {
        //dd($request);
        Docs::where('id', $request->id)->update([
            'title' => $request->title,
            'value' => $request->content
        ]);
        $file = Docs::where('id', $request->id)->first();
        $parent = Folder::where('id', $file->parent)->first();
        //Storage::disk('docs')->delete($request->url);
        //$folderArray = explode('/', $request->url);
        // $folder = $folderArray[0] . '/' . $folderArray[1];
        // $newFileName = $folder . '/' . $request->title;
        // Storage::disk('docs')->put($newFileName, $request->content);
        // $content = Storage::disk('docs')->get($newFileName);
        Storage::disk('docs')->delete($parent->folder . '1.0/rendered/' . $request->title . '.md');
        $convert = new HtmlConverter();
        $convert->getConfig()->setOption('hard_break', false);
        $markdown = $convert->convert($request->content);
        Storage::disk('docs')->put($parent->folder . '/1.0/rendered/' . $request->title . '.md', $markdown);
        Session::flash('message', 'Save Succesful');
        return redirect('/home/docs/editor?url=' . $request->id);
    }
    public function removeParent($id)
    {
        $getFolder =  Folder::where('id', $id)->first();
        // $folder = '';
        // foreach ($getFolder as $g) {
        //     $folder = $g->folder;
        // }
        Docs::where('parent', $id)->delete();
        Storage::disk('docs')->deleteDirectory($getFolder->folder);
        Folder::destroy($id);
        Session::flash('message', 'Parent Successfully Removed');
        return redirect('/home/docsman');
    }
    public function editParent(Request $request)
    {
        $getFolder = Folder::where('id', $request->id)->first();
        // $folder = '';
        // foreach ($getFolder as $g) {
        //     $folder = $g->folder;
        // }
        $file = Docs::where('parent', $getFolder->id)->first();
        if (!is_null($file)) {
            Storage::disk('docs')->move($getFolder, $request->company);
            //rename('../resources/docs/' . $getFolder->folder, '../resources/docs/' . $request->company);
            Folder::where('id', $request->id)->update([
                'folder' => $request->company
            ]);
            Session::flash('message', $getFolder->folder . ' name successfully changed');
        } else {
            Storage::disk('docs')->makeDirectory($request->company . '/1.0/rendered');
            Docs::create([
                'parent' => $getFolder->id,
                'title' => 'index',
                'value' => Storage::disk('docs')->get('master/1.0/index')
            ]);
            Docs::create([
                'parent' => $getFolder->id,
                'title' => 'overview',
                'value' => Storage::disk('docs')->get('master/1.0/overview')
            ]);
            Storage::disk('docs')->copy('master/1.0/rendered/index.md', $request->company . '/1.0/rendered/index.md');
            Storage::disk('docs')->copy('master/1.0/rendered/overview.md', $request->company . '/1.0/rendered/overview.md');
            Session::flash('message', $getFolder->folder . ' name successfully re-created');
        }

        return redirect('home/docsman');
    }
    public function delFile(Request $request)
    {
        //Storage::disk('docs')->delete($request->path);
        Docs::where('id', $request->path)->delete();
        Session::flash('message',  'File is Successfully deleted');
        return redirect(url()->previous());
    }

    public function downloadPdf()
    {
        //return view('docs.template.front');
        //
        $company = Auth::user()->company;
        //$files = Storage::disk('docs')->files($company .'/1.0');
        //$file = Storage::disk('docs')->get($company . '/1.0/index');
        //dd($file);
        //preg_match_all('/(?=\/[a-z]+)(?:(?!\042|\/li|\/ul|\/h2|\/a).)*/', $file, $matches,);
        // $filtered = array_filter($matches[0], function ($data) {
        // return ($data != null);
        // });
        //dd($filtered);
        //$docs = '';
        $folder = Folder::where('folder', $company)->first();
        $docs = Docs::where('parent', $folder->id)->get();
        $i = 1;
        $pdf_cover = PDF::loadView('docs.template.front');
        $pdf_cover->save(storage_path('app\temp\joined-' . $company . '0.pdf'));
        foreach ($docs as $f) {
            //$slug = explode('/', $f);
            //$docs = Storage::disk('docs')->get($company . '/1.0/' . $slug[1]);
            //$docs = Storage::disk('docs')->get($f)
            $pdf = PDF::loadHTML($f->value);

            $pdf->save(storage_path('app\temp\joined-' . $company . $i++ . '.pdf'));
        }
        $pdf_backcover = PDF::loadView('docs.template.back');
        $pdf_backcover->save(storage_path('app\temp\joined-' . $company . '9999.pdf'));
        $merger = new \Jurosh\PDFMerge\PDFMerger;
        $joined = Storage::files('temp');
        foreach ($joined as $j) {
            $merger->addPDF(storage_path('app/' . $j));
        }
        $merger->merge('file', storage_path('app/temp/Grapiku-Docs_' . $company . '.pdf'));
        File::delete(File::glob(storage_path('app/temp/joined-*.*')));
        return response()->download(storage_path('app/temp/Grapiku-Docs_' . $company . '.pdf'), 'Grapiku Docs - ' . $company . '.pdf')->deleteFileAfterSend(true);

        //        $pdf = PDF::loadHTML($docs);
        //        return $pdf->download($company.'.pdf');

    }
}
