@include('Include.head')
<style>
  label {
    font-size: 15px;
    font-weight: bold;
  }
</style>

<body>
  @include('Include.AD_BodyTop')

  <form action="{{ $SecTitle_Action == '新增' ? route('bulletins.store') : route('bulletins.update', $bulletin->id) }}" 
        method="POST" enctype="multipart/form-data">
    @csrf
    @if($SecTitle_Action != '新增')
      @method('PUT')
    @endif
    <div class="w-5/5 my-2">
      <div class="row gy-4 align-items-start">

        <!-- 公告標題 -->
        <div class="col-lg-12">

          <label for="Bulletin_Title">公告標題:</label>
          <input type="text" name="Bulletin_Title" id="Bulletin_Title" 
                 value="{{ old('Bulletin_Title', $bulletin->Bulletin_Title ?? '') }}">
          @error('Bulletin_Title')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- 公告類別 -->
        <div class="col-lg-12">
          <label for="main_cate_id">公告類別:</label>
          <select name="main_cate_id" id="main_cate_id">
            <option value="">-請選擇-</option>
            @foreach ($MainCates as $cate)
              <option value="{{ $cate->id }}" 
                      {{ old('main_cate_id', $bulletin->main_cate_id ?? '') == $cate->id ? 'selected' : '' }}>
                {{ $cate->MainCate_Name }}
              </option>
            @endforeach
          </select>
          @error('main_cate_id')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- 公告開始時間 -->
        <div class="col-lg-12">
          <label for="Bulletin_StartDate">公告開始時間:</label>
          <input type="date" name="Bulletin_StartDate" id="Bulletin_StartDate" 
                 value="{{ old('Bulletin_StartDate', $bulletin->Bulletin_StartDate ?? '') }}">
          @error('Bulletin_StartDate')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- 公告結束時間 -->
        <div class="col-lg-12">
          <label for="Bulletin_EndDate">公告結束時間:</label>
          <input type="date" name="Bulletin_EndDate" id="Bulletin_EndDate" 
                 value="{{ old('Bulletin_EndDate', $bulletin->Bulletin_EndDate ?? '') }}">
          @error('Bulletin_EndDate')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- 公告內文 -->
        <div class="col-lg-12">
          <label for="Bulletin_Content">內文:</label>
          <textarea name="Bulletin_Content" id="Bulletin_Content">{{ old('Bulletin_Content', $bulletin->Bulletin_Content ?? '') }}</textarea>
          @error('Bulletin_Content')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- 是否永久上架 -->
        <div class="col-lg-12">
          <label for="Bulletin_Forever">是否永久上架:</label>
          <input type="checkbox" name="Bulletin_Forever" id="Bulletin_Forever" 
                 {{ old('Bulletin_Forever', $bulletin->Bulletin_Forever ?? 0) ? 'checked' : '' }}>
          @error('Bulletin_Forever')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- 是否顯示 -->
        <div class="col-lg-12">
          <label for="Bulletin_Enable">是否顯示:</label>
          <input type="checkbox" name="Bulletin_Enable" id="Bulletin_Enable" 
                 {{ old('Bulletin_Enable', $bulletin->Bulletin_Enable ?? 0) ? 'checked' : '' }}>
        </div>

        <!-- 上傳檔案 -->
        <div class="col-lg-12">
          <label for="files">上傳相關檔案：</label>
          <input type="file" name="files[]" multiple>
          @error('files')
            <div class="text-danger">{{ $message }}</div>
          @enderror
          <div style="width:100%;margin-top:20px;">
            <div class="row gy-4 gx-2 align-items-center">
              @if(isset($ThisFile))
              @foreach($ThisFile->files as $ThisFileData)  
              <div class="col-4">
                <img src="{{ asset('storage/' . $ThisFileData->File_FakeName) }}" style="width:100%;">
              </div>
              @endforeach
              @endif
            </div>
          </div>
        </div>
        <!-- 提交按鈕 -->
        <div class="col-lg-12" style="text-align:center;">
          <input type="submit" class="btn btn-primary" value="送出">
        </div>
      </div>
    </div>
  </form>

  @include('Include.AD_BodyFoot')
</body>

<script>
  ClassicEditor
    .create(document.querySelector('#Bulletin_Content'), {
      toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'imageUpload'],
      image: {
        toolbar: ['imageTextAlternative', 'imageUpload']
      },
      simpleUpload: {
        uploadUrl: '/upload-image',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      }
    })
    .catch(error => console.error(error));
</script>

</html>
