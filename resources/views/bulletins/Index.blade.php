@include('Include.head')
<style>
 
</style>
<body>
    @include('Include.AD_BodyTop')
    <div class="w-5/5 my-2">
        <div class="row align-items-start">
          <div class="col">
            <button type="button" class="btn btn-success" onclick="location.href='{{ route('bulletins.create') }}'">
                <i class="fa-solid fa-plus"></i>&nbsp;新增{{ $SecTitle }}
            </button>
            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('mainCates.index') }}?Module={{ $Module }}'">
                <i class="fa-solid fa-list"></i>&nbsp;類別管理
            </button>
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
      <pre>
        
      </pre>
    <table class="table table-striped table-bordered table-rwd">
        <tr class="tr-only-hide">
            <th>公告標題</th>
            <th>公告開始時間</th>
            <th>公告結束時間</th>
            <?php /* ?>
            <th>公告內容</th>
            <?php */ ?>
            <th>操作</th>
        </tr>
        @foreach ($DataList as $ThisData)
        <tr>
            <td data-th="公告標題">
              <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $ThisData->id }}">{{ $ThisData->Bulletin_Title }}</a>
              <div class="modal fade" id="exampleModal{{ $ThisData->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">
                          <span style="background-color:{{ $ThisData->mainCate->MainCate_Color }};color:{{ $ThisData->mainCate->MainCate_FontColor }};padding:5px;padding-left:10px;padding-right:10px;">{{ $ThisData->mainCate->MainCate_Name }}</span>
                          {{ $ThisData->Bulletin_Title }}
                      </h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div style="width:100%;">
                        <div class="row">
                          <div class="col-lg-12">
                            <label>公告開始時間:</label>
                            {{ $ThisData->Bulletin_StartDate }}
                          </div>
                          <div class="col-lg-12">
                            <label>公告結束時間:</label>
                            {{ $ThisData->Bulletin_EndDate }}
                          </div>
                          <div class="col-lg-12">
                            <label>公告內容:</label>
                            {!! $ThisData->Bulletin_Content !!}
                          </div>
                          <div class="col-lg-12">
                              @foreach($ThisData->files as $ThisFileDetail) 
                              <a href="{{ asset('storage/' . $ThisFileDetail->File_FakeName) }}" download="{{ $ThisFileDetail->File_FakeName }}">
                                  <img src="{{ asset('storage/' . $ThisFileDetail->File_FakeName) }}" style="width:100%;">
                              </a>
                              @endforeach
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
            <td data-th="公告開始時間">{{ $ThisData->Bulletin_StartDate }}</td>
            <td data-th="公告結束時間">{{ $ThisData->Bulletin_EndDate }}</td>
            <td data-th="操作">
                <form action="{{ route('bulletins.destroy', $ThisData->id) }}" onsubmit="return confirm('您確定要刪除{{ $ThisData->Bulletin_Title }}');" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">刪除</button>
                  <button type="button" class="btn btn-success" onclick="location.href='{{ route('bulletins.edit', $ThisData->id) }}'" >修改</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
      {{ $DataList->links() }}
    @include('Include.AD_BodyFoot')
</body>

</html>
