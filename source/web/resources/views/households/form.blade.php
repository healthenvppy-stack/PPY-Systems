<div class="row">

    <div class="col-md-4 mb-3">
        <label>รหัสบ้าน</label>
        <input type="text" name="house_code" class="form-control"
               value="{{ old('house_code', $household->house_code ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>บ้านเลขที่</label>
        <input type="text" name="house_no" class="form-control"
               value="{{ old('house_no', $household->house_no ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>หมู่</label>
        <input type="text" name="moo" class="form-control"
               value="{{ old('moo', $household->moo ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>ถนน</label>
        <input type="text" name="road" class="form-control"
               value="{{ old('road', $household->road ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>ซอย</label>
        <input type="text" name="alley" class="form-control"
               value="{{ old('alley', $household->alley ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>รหัสไปรษณีย์</label>
        <input type="text" name="postcode" class="form-control"
               value="{{ old('postcode', $household->postcode ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>Latitude</label>
        <input type="text" name="latitude" class="form-control"
               value="{{ old('latitude', $household->latitude ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>Longitude</label>
        <input type="text" name="longitude" class="form-control"
               value="{{ old('longitude', $household->longitude ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>โซนน้ำท่วม</label>
        <select name="flood_level" class="form-control">
            <option value="0" {{ old('flood_level', $household->flood_level ?? 0) == 0 ? 'selected' : '' }}>เขียว / ไม่ท่วม</option>
            <option value="2" {{ old('flood_level', $household->flood_level ?? 0) == 2 ? 'selected' : '' }}>เหลือง / เล็กน้อย</option>
            <option value="3" {{ old('flood_level', $household->flood_level ?? 0) == 3 ? 'selected' : '' }}>ส้ม / ปานกลาง</option>
            <option value="4" {{ old('flood_level', $household->flood_level ?? 0) == 4 ? 'selected' : '' }}>แดง / ท่วมหนัก</option>
        </select>
    </div>

</div>