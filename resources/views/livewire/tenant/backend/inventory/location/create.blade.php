<div>
    <x-new-modal wireKey="isOpen">
        <form wire:submit.prevent="create">
            
            <x-form.row.input wireKey="location.name" key="name" label="Tên địa điểm" row="grid"></x-form.row.input>

            <x-form.row.select wireKey="location.type" key="type" label="Loại địa điểm" row="grid" {{-- blankoption=false --}}>
                    <option value='{"value": "shop", "label": "Cửa hàng"}'>Cửa Hàng</option>
                    <option value='{"value": "depot", "label": "Tổng kho"}'>Tổng Kho</option>
                    <option value='{"value": "warehouse", "label": "Kho"}'>Kho</option>
                    <option value='{"value": "office", "label": "Văn phòng"}'>Văn phòng</option>
                    <option value='{"value": "branch", "label": "Chi nhánh"}'>Chi Nhánh</option>
                    <option value='{"value": "other", "label": "Khác"}'>Khác</option>
            </x-form.row.select>

            <x-form.row.input wireKey="location.address" key="address" label="Địa chỉ" row="grid"></x-form.row.input>
    
            {{-- @livewire('tenant.backend.select-address') --}}

            <x-form.row.select wireKey="location.province_id" key="province_id" label="Tỉnh/Thành" row="grid">
                @if (!empty($provinces))
                    @foreach ($provinces as $province)
                        <option value={{ $province->id }}>{{ $province->name }}</option>
                    @endforeach
                @endif   
            </x-form.row.select>

            <x-form.row.select wireKey="location.district_id" key="district_id" label="Quận/Huyện" row="grid">
                @if (!empty($location->province_id))
                    @foreach ($districts as $district)
                        <option value={{ $district->id }}>{{ $district->name }}</option>
                    @endforeach
                @endif   
            </x-form.row.select>

            <x-form.row.select wireKey="location.ward_id" key="ward_id" label="Xã/Phường" row="grid">
                @if (!empty($location->district_id))
                
                    @foreach ($wards as $ward)
                        <option value={{ $ward->id }}>{{ $ward->name }}</option>
                    @endforeach 
                @endif 
            </x-form.row.select>

            <x-form.row.input wireKey="location.phone" key="phone" label="Điện thoại" row="grid"></x-form.row.input>

            <x-form.row.input wireKey="location.operating_time" key="operating_time" label="Thời gian hoạt động" row="grid"></x-form.row.input>

            <x-form.row.input wireKey="location.note" key="note" label="Ghi chú" row="grid"></x-form.row.input>
            
            <p class="text-right">
                <x-button.primary wire:click.prevent="store">{{ $submitLabel }}</x-button.primary>               
            </p>
        
        </form>
    </x-new-modal>
</div>