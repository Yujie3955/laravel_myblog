@include('Include.head')
<body>
    @include('Include.AD_BodyTop')
    <div class="w-5/5 my-2">
        <div class="row align-items-start">
          <div class="col">
            @if (isset($keyword))
            <button type="button" class="btn btn-success" onclick="location.href='{{ route('mainCates.create') }}?Module={{ $keyword }}'">
              <i class="fa-solid fa-plus"></i>&nbsp;新增{{ $SecTitle }}
            </button>
            @else
            <button type="button" class="btn btn-success" onclick="location.href='{{ route('mainCates.create') }}'">
              <i class="fa-solid fa-plus"></i>&nbsp;新增{{ $SecTitle }}
            </button>
            @endif
            
            @if(isset($keyword))
            <button type="button" class="btn btn-secondary" onclick="location.href='{{ $keyword }}'">
                <i class="fa-solid fa-list"></i>&nbsp;上一頁
            </button>
            @endif
          
          </div>
          <div class="col">
          </div>
        </div>
      </div>
      @if ($message = Session::get('success'))
          <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-3" role="alert">
            <div class="flex">
              <div>
                <p class="text-sm">{{ $message }}</p>
              </div>
            </div>
          </div>
      @endif
    <table class="table table-striped table-bordered table-rwd">
        <tr class="tr-only-hide">
            <th>類別名稱</th>
            <th>類別樣式</th>
            <th>類別模組</th>
            <td>操作</td>
        </tr>
        @foreach ($DataList as $ThisData)
        <tr>
            <td data-th="類別名稱">
              <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $ThisData->id }}">{{ $ThisData->MainCate_Name }}</a>
              <div class="modal fade" id="exampleModal{{ $ThisData->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $ThisData->MainCate_Name }}</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      
                      <div style="width:100%;">
                        <div class="row">
                          <div class="col-lg-12">
                            <label>類別名稱:</label>
                            {{ $ThisData->MainCate_Name }}
                          </div>
                          <div class="col-lg-12">
                            <label>類別樣式:</label>
                            <span style="background-color:{{ $ThisData->MainCate_Color }};color:{{ $ThisData->MainCate_FontColor }};padding:5px;padding-left:10px;padding-right:10px;">{{ $ThisData->MainCate_Name }}</span>
                          </div>
                          <div class="col-lg-12">
                            <label>類別模組:</label>
                            {{ $ThisData->Module_Name }}
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                    </div>
                  </div>
                </div>
              </div>
              {{--  <a href="{{ route('bulletins.show',$ThisData->id) }}">{{ $ThisData->Bulletin_Title }}</a>  --}}
            </td>
            <td data-th="類別樣式">
              <span style="background-color:{{ $ThisData->MainCate_Color }};color:{{ $ThisData->MainCate_FontColor }};padding:5px;padding-left:10px;padding-right:10px;">{{ $ThisData->MainCate_Name }}</span>
            </td>
            <td data-th="類別模組">{{ $ThisData->Module_Name }}</td>
            <td data-th="操作">
                <form action="{{ route('mainCates.destroy', $ThisData->id) }}" onsubmit="return confirm('您確定要刪除{{ $ThisData->Module_Name }}');" method="POST">
                  @csrf
                  @method('DELETE')
                  <input type="hidden" name="Module" value="{{ $ThisData->Module_Name }}">
                  <button type="submit" class="btn btn-danger">刪除</button>
                  <button type="button" class="btn btn-success" onclick="location.href='{{ route('mainCates.edit', $ThisData->id) }}'" >修改</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
      {{ $DataList->links() }}
    @include('Include.AD_BodyFoot')
</body>

</html>
