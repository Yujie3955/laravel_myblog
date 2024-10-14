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
      <form action="{{ route('mainCates.store') }}" method="post">
    @else
      <form action="{{ route('mainCates.update', $mainCate->id) }}" method="post">
      @method('PUT')
    @endif
    @csrf
    <div class="w-5/5 my-2">
        <div class="row gy-4 align-items-start">
          <div class="col-lg-12">
            <label for="MainCate_Name">類別名稱:</label>
            <input type="text" name="MainCate_Name" id="MainCate_Name" @if(isset($mainCate)) value="{{ $mainCate->MainCate_Name }}" @endif>
          </div>
          @if(!isset($keyword))
            <div class="col-lg-12">
              <label for="Module_Name">模組名稱:</label>
              <input type="text" name="Module_Name" id="Module_Name" @if(isset($mainCate)) value="{{ $mainCate->Module_Name }}" @endif>
            </div>
          @endif
          <div class="col-lg-12">
            <label for="MainCate_Color">類別背景顏色:</label>
            <input type="color" name="MainCate_Color" id="MainCate_Color" @if(isset($mainCate)) value="{{ $mainCate->MainCate_Color }}" @endif>
          </div>
          <div class="col-lg-12">
            <label for="MainCate_FontColor">類別字體顏色:</label>
            <input type="color" name="MainCate_FontColor" id="MainCate_FontColor" @if(isset($mainCate)) value="{{ $mainCate->MainCate_FontColor }}" @endif>
          </div>
          <div class="col-lg-12">
              <input type="submit" class="btn btn-primary" value="送出">
          </div>
        </div>
      </div>
      @if(isset($keyword))
        <input type="hidden" name="Module_Name" id="Module_Name" @if(isset($keyword)) value="{{ $keyword }}" @endif>
      @endif
    </form>
    @include('Include.AD_BodyFoot')
</body>
</html>
