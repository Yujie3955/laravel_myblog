@include('Include.head')
<style>
  label{
    font-size:15px;
    font-weight:bold;
  }
</style>
<body>
    @include('Include.AD_BodyTop')
    @if($SecTitle_Action=='新增')
      <form action="{{ route('bulletins.store') }}" method="post" enctype="multipart/form-data">
    @else
      <form action="{{ route('bulletins.update', $bulletin->id) }}" method="post" enctype="multipart/form-data">
      @method('PUT')
    @endif
    @csrf
    <div class="w-5/5 my-2">
        <div class="row gy-4 align-items-start">
          <div class="col-lg-12">
            @error('Bulletin_Title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <label for="Bulletin_Title">公告標題:</label>
            <input type="text" name="Bulletin_Title" id="Bulletin_Title" @if(isset($bulletin)) value="{{ $bulletin->Bulletin_Title }}" @endif>
          </div>
          <div class="col-lg-12">
            <label for="main_cate_id">公告類別:</label>
            @error('main_cate_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <select name="main_cate_id">
                <option value="">-請選擇-</option>
                @foreach ($MainCates as $cate)
                    <option value="{{ $cate->id }}" @if(isset($bulletin)) @if($cate->id==$bulletin->main_cate_id) selected @endif @endif>{{ $cate->MainCate_Name }}</option>
                @endforeach
            </select>
          </div>
          <div class="col-lg-12">
            <label for="Bulletin_StartDate">公告開始時間:</label>
            @error('Bulletin_StartDate')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="date" name="Bulletin_StartDate" id="Bulletin_StartDate" @if(isset($bulletin)) value="{{ $bulletin->Bulletin_StartDate }}" @endif>
          </div>
          <div class="col-lg-12">
            <label for="Bulletin_EndDate">公告結束時間:</label>
            @error('Bulletin_EndDate')
              <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="date" name="Bulletin_EndDate" id="Bulletin_EndDate" @if(isset($bulletin)) value="{{ $bulletin->Bulletin_EndDate }}" @endif>
          </div>
          <div class="col-lg-12">
            <label for="Bulletin_Content">內文:</label>
            @error('Bulletin_Content')
              <div class="text-danger">{{ $message }}</div>
            @enderror
            <textarea name="Bulletin_Content" id="Bulletin_Content">@if(isset($bulletin)){{ $bulletin->Bulletin_Content }}@endif</textarea>
          </div>
          <div class="col-lg-12">
            <label for="Bulletin_Forever">是否永久上架:</label>
            @error('Bulletin_Forever')
              <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="checkbox" name="Bulletin_Forever" id="Bulletin_Forever" @if(isset($bulletin)) @if($bulletin->Bulletin_Forever==1) checked @endif @endif>
          </div>
          <div class="col-lg-12">
            <label for="Bulletin_Enable">是否顯示:</label>
            <input type="checkbox" name="Bulletin_Enable" id="Bulletin_Enable" @if(isset($bulletin)) @if($bulletin->Bulletin_Enable==1) checked @endif @endif>
          </div>
          <div class="col-lg-12">
              <label for="files">上傳相關檔案：</label>
              <input type="file" name="files[]" multiple>
          </div>
          <div class="col-lg-12">
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
          // 這裡是圖片上傳的配置
          image: {
              toolbar: [
                  'imageTextAlternative', // 圖片替代文字
                  'imageUpload' // 圖片上傳按鈕
              ]
          },
          // 圖片上傳處理
          simpleUpload: {
              uploadUrl: '/upload-image', // 替換為你的圖片上傳 API 路徑
              headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF 令牌
              }
          }
      })
      .catch(error => {
          console.error(error);
      });
</script>

</html>
