<div class="form-group">
    <label>Nama<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="name" value="{{ isset($name) ? $name : old('name') }}">
    <span class="text-danger" id="name_error"></span>
</div>
<!-- /.form-group -->
<div class="form-group">
    <label>Kontak (Sales)<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="person" value="{{ isset($person) ? $person : old('person') }}">
    <span class="text-danger" id="person_error"></span>
</div>
<div class="form-group">
    <label>Telepon<span class="text-danger">*</span></label>
    <input type="number" class="form-control" name="phone_number"
        value="{{ isset($phone_number) ? $phone_number : old('phone_number') }}">
    <span class="text-danger" id="phone_number_error"></span>
</div>
<div class="form-group">
    <label for="">Alamat<span class="text-danger">*</span></label>
    <textarea name="address" class="form-control" cols="10" rows="4">{{ isset($address) ? $address : old('address') }}</textarea>
    <span class="text-danger" id="address_error"></span>
</div>
