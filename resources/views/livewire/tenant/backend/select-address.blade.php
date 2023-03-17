<div>
    <div class="my-4">
        <label for="province">Tỉnh/Thành</label>
        <select wire:model="selectedProvince" id="province" name="province">
            @if ($provinces)
                <option value>---Chọn tỉnh/thành---</option>
                @foreach ($provinces as $province)
                    <option value='{"id":{{ $province->id }}, "name": "{{ $province->name }}"}'>{{ $province->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    @if (!is_null($selectedProvince))
        <div class="my-4">
            <label for="district">Quận/Huyện</label>
            <select wire:model="selectedDistrict" id="district" name="district">
                <option value>---Chọn Quận/Huyện---</option>
                @foreach ($districts as $district)
                    <option value='{"id":{{ $district->id }}, "name": "{{ $district->name }}"}'>{{ $district->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

    @if (!is_null($selectedDistrict))
        <div class="my-4">
            <label for="ward">Xã/Phường</label>
            <select wire:model="selectedWard" id="ward" name="ward">
                <option value>---Chọn Xã/Phường---</option>
                @foreach ($wards as $ward)
                    <option value='{"id":{{ $ward->id }}, "name": "{{ $ward->name }}"}'>{{ $ward->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

</div>
