<?php

namespace App\Http\Controllers;

use App\Models\MainCate;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMainCateRequest;
use App\Http\Requests\UpdateMainCateRequest;

class MainCateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $SecTitle ='類別管理';
    public function index(Request $request)
    {
        // 取得 GET 參數 'Module'
        $keyword = $request->get('Module'); 

        // 使用 when 條件來決定查詢邏輯
        $mainCates = MainCate::when($keyword, function ($query, $keyword) {
            return $query->where('Module_Name', $keyword);
        })->latest()->paginate(5); // 無論是否有關鍵字，最後都可以排序並分頁

        return view('maincate.Index', [
            'keyword' => $keyword,
            'DataList' => $mainCates,
            'SecTitle' => $this->SecTitle
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //Get欄位
        $keyword = $request->get('Module'); 
        
        return view('maincate.AD_Data',[
            'keyword' =>$keyword,
            'SecTitle' =>$this->SecTitle,
            'SecTitle_Action'=>'新增',
            'Flag_LastPage'=>'mainCates'  //啟用回列表頁功能
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMainCateRequest $request)
    {
        $data = $request->all();
        MainCate::create($data);
        return redirect()->route('mainCates.index',['Module' => $data['Module_Name']])
                ->withSuccess($this->SecTitle.'新增成功');
            
    }

    /**
     * Display the specified resource.
     */
    public function show(MainCate $mainCate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MainCate $mainCate,Request $request)
    {
        //Get欄位
        $keyword = $request->get('Module'); 
        //調取目前擁有的欄位
        $MainCate_All = new MainCate();
        $MainCate_Fill =  $MainCate_All->getFillable();

        return view('maincate.AD_Data', [
            'keyword' => $keyword,
            'mainCate' => $mainCate,
            'fillable' => $MainCate_Fill,
            'SecTitle_Action'=>'修改',
            'SecTitle' => $this->SecTitle,
            'Flag_LastPage'=>'mainCates'  //啟用回列表頁功能
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMainCateRequest $request, MainCate $mainCate)
    {
        $data = $request->validated();  // 使用 validated() 而不是 all()，确保只获取通过验证的字段
         
        $mainCate->update($data);
 
        // 返回成功信息
        return redirect()->route('mainCates.index',['Module'=>$data['Module_Name']])
                         ->withSuccess('公告修改成功');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainCate $mainCate,Request $request)
    {
        $mainCate->delete();
        $keyword = $request->get('Module'); 
        return redirect()->route('mainCates.index',['Module'=>$keyword])
                ->withSuccess($this->SecTitle.'資料刪除成功');
    }
}
