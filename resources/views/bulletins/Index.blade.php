@include('Include.head')
<body>
    @include('Include.AD_BodyTop')
    <div class="w-5/5 my-2">
        <div class="row align-items-start">
          <div class="col">
            <button type="button" class="btn btn-success" onclick="location.href='{{ route('bulletins.create') }}'">
                <i class="fa-solid fa-plus"></i>&nbsp;新增{{ $SecTitle }}
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
    <table class="table table-striped table-bordered table-rwd">
        <tr class="tr-only-hide">
            <th>公告標題</th>
            <th>公告開始時間</th>
            <th>公告結束時間</th>
            <th>公告內容</th>
            <td>操作</td>
        </tr>
        @foreach ($DataList as $ThisData)
        <tr>
            <td data-th="公告標題"><a href="{{ route('bulletins.show',$ThisData->id) }}">{{ $ThisData->Bulletin_Title }}</a></td>
            <td data-th="公告開始時間">{{ $ThisData->Bulletin_StartDate }}</td>
            <td data-th="公告結束時間">{{ $ThisData->Bulletin_EndDate }}</td>
            <td data-th="公告內容">
              {{ $ThisData->Bulletin_Content }}
            </td>
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
