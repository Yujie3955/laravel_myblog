<?php

namespace App\Http\Controllers;
use App\Models\Bulletin;
use App\Http\Requests\StoreBulletinRequest;
use App\Http\Requests\UpdateBulletinRequest;


class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $SecTitle ='最新公告';
    public $Module = 'bulletins';
    public function index()
    {
        return view('bulletins.Index', [
            'DataList' => Bulletin::latest()->paginate(5),
            'SecTitle' => $this->SecTitle,
            'Module'=> $this->Module
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bulletins.AD_Data',[
            'SecTitle' =>$this->SecTitle,
            'SecTitle_Action'=>'新增',
            'Flag_LastPage'=>'bulletins'  //啟用回列表頁功能
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreBulletinRequest $request)
    {
        $data = $request->all();
        $data['Bulletin_Forever'] = $request->has('Bulletin_Forever') ? '1' : '0';
        $data['Bulletin_Enable'] = $request->has('Bulletin_Enable') ? '1' : '0';
        Bulletin::create($data);
        
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

        return view('bulletins.AD_Data', [
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
    public function destroy(Bulletin $bulletin)
    {
        $bulletin->delete();
        return redirect()->route('bulletins.index')
                ->withSuccess($this->SecTitle.'資料刪除成功');
    }
}
