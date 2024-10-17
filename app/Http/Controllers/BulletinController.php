<?php

namespace App\Http\Controllers;
use App\Models\Bulletin;
use App\Models\MainCate;
use App\Models\DataFile;
use App\Http\Requests\StoreBulletinRequest;
use App\Http\Requests\UpdateBulletinRequest;
use Illuminate\Support\Facades\Storage;


class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $SecTitle ='最新公告';
    public $Module = 'bulletins';
    public function index()
    {
        $bulletins = Bulletin::with(['mainCate', 'files'])->latest()->paginate(5);
        return view('bulletins.Index', [
            'DataList' =>  $bulletins,
            'SecTitle' => $this->SecTitle,
            'Module'=> $this->Module
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainCates = MainCate::all();
        return view('bulletins.AD_Data',[
            'SecTitle' =>$this->SecTitle,
            'SecTitle_Action'=>'新增',
            'MainCates'=>$mainCates,
            'Flag_LastPage'=>'bulletins'  //啟用回列表頁功能
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreBulletinRequest $request)
    {
        //$data = $request->validated(); // 使用 validated() 方法來獲取驗證後的資料
        $data = $request->all();
        
        //$data = $request->all();
        $data['Bulletin_Forever'] = $request->has('Bulletin_Forever') ? '1' : '0';
        $data['Bulletin_Enable'] = $request->has('Bulletin_Enable') ? '1' : '0';

        $bulletin=Bulletin::create($data);
        
        
        // 處理檔案上傳
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // 檢查是否為檔案物件
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $this->uploadFile($file, $bulletin->id, 'Bulletin');
                }
            }
        }
       return redirect()->route('bulletins.index')
                ->withSuccess($this->SecTitle.'新增成功');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bulletin $bulletin)
    {
        return view('bulletins.show', [
            'bulletin' => $bulletin
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bulletin $bulletin)
    {
        //調取目前擁有的欄位
        $Bulletin_All = new Bulletin();
        $Bulletin_Fill =  $Bulletin_All->getFillable();
        $mainCates = MainCate::all();

        $ThisFile = Bulletin::with(['mainCate', 'files'])
            ->where('id', $bulletin->id)
            ->whereHas('files', function ($query) {
                $query->where('Module', 'Bulletin');
            })
            ->first();


        return view('bulletins.AD_Data', [
            'ThisFile' => $ThisFile,
            'MainCates' => $mainCates,
            'bulletin' => $bulletin,
            'fillable' => $Bulletin_Fill,
            'SecTitle_Action'=>'修改',
            'SecTitle' => $this->SecTitle,
            'Flag_LastPage'=>'bulletins'  //啟用回列表頁功能
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBulletinRequest $request, Bulletin $bulletin)
    {
        // 只抓取 $fillable 里允许的字段
        $data = $request->validated();  // 使用 validated() 而不是 all()，确保只获取通过验证的字段
        
        // 处理复选框字段：未勾选的复选框不会包含在请求中，所以手动设置
        $data['Bulletin_Forever'] = $request->has('Bulletin_Forever') ? '1' : '0';
        $data['Bulletin_Enable'] = $request->has('Bulletin_Enable') ? '1' : '0';
        
        // 更新 bulletin 数据
        $bulletin->update($data);

        // 返回成功信息
        return redirect()->route('bulletins.index')
                        ->withSuccess('公告修改成功');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Bulletin $bulletin)
    // {
    //     $bulletin->delete();
    //     return redirect()->route('bulletins.index')
    //             ->withSuccess($this->SecTitle.'資料刪除成功');
    // }

    public function destroy(Bulletin $bulletin)
    {
        // 刪除與公告相關的檔案
        foreach ($bulletin->files as $file) {
            // 檢查檔案是否存在於存儲中
            if (Storage::exists($file->File_FakeName)) {
                Storage::delete($file->File_FakeName); // 刪除檔案
            }
            $file->delete(); // 刪除資料表中的檔案記錄
        }

        // 刪除公告
        $bulletin->delete();

        return redirect()->route('bulletins.index')
                ->withSuccess($this->SecTitle.'資料刪除成功');
    }
    
    protected function uploadFile($file, $bulletinId, $module)
    {
        // 獲取原始檔名
        $originalName = $file->getClientOriginalName();
        // 儲存檔案
        $path = $file->store('uploads', 'public');
        // 儲存檔案信息到資料庫
        DataFile::create([
            'File_Name' => $originalName,
            'File_FakeName' => $path,
            'File_Ext' => $file->getClientOriginalExtension(),
            'Module' => $module,
            'AutoID' => $bulletinId,
        ]);
    }
}
