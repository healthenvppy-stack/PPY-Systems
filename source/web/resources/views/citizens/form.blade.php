<div class="row">

    <div class="col-md-4 mb-3">
        <label>เลขบัตรประชาชน</label>
        <input type="text" name="cid" class="form-control" value="{{ old('cid', $citizen->cid ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>ชื่อ</label>
        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $citizen->first_name ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>นามสกุล</label>
        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $citizen->last_name ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>เพศ</label>
        <select name="gender" class="form-control">
            <option value="ชาย">ชาย</option>
            <option value="หญิง">หญิง</option>
        </select>
    </div>

    <div class="col-md-4 mb-3">
        <label>วันเกิด</label>
        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', isset($citizen) ? optional($citizen->birth_date)->format('Y-m-d') : '') }}">
    </div>

</div>