<div>
    <x-new-modal wireKey="isOpen">
        <form wire:submit.prevent="create">

            <x-form.row.input wireKey="supplier.company_name" key="company_name" label="Nhà cung cấp*" row="grid"></x-form.row.input>
            {{-- <x-form.row.input type="file" wireKey="supplier.logo" key="contact_name" label="Logo" row="grid"></x-form.row.input> --}}

            <div class="grid grid-cols-2 gap-4">
                <div class="">      
                    <x-form.row.select wireKey="supplier.ranking" key="ranking" label="Phân loại" row="grid" {{-- blankoption=false --}}>
                        <option value='A'>A</option>
                        <option value='B'>B</option>
                        <option value='C'>C</option>
                        <option value='D'>D</option>
                    </x-form.row.select>
        
                    <x-form.row.input wireKey="supplier.contact_name" key="contact_name" label="Người liên hệ*" row="grid"></x-form.row.input>
                    
                </div>

                <div class="">

                    <x-form.row.input wireKey="supplier.field" key="field" label="Lĩnh vực" row="grid"></x-form.row.input>

                    <x-form.row.input wireKey="supplier.contact_title" key="contact_title" label="Chức danh" row="grid"></x-form.row.input>

                </div>
            </div>

            <x-form.row.input wireKey="supplier.address" key="address" label="Địa chỉ" row="grid"></x-form.row.input>

            <x-form.row.select wireKey="supplier.province_id" key="province_id" label="Tỉnh/Thành" row="grid">
                @if (!empty($provinces))
                    @foreach ($provinces as $province)
                        <option value={{ $province->id }}>{{ $province->name }}</option>
                    @endforeach
                @endif   
            </x-form.row.select>

            <x-form.row.select wireKey="supplier.district_id" key="district_id" label="Quận/Huyện" row="grid">
                @if (!empty($supplier->province_id))
                    @foreach ($districts as $district)
                        <option value={{ $district->id }}>{{ $district->name }}</option>
                    @endforeach
                @endif   
            </x-form.row.select>

            <x-form.row.select wireKey="supplier.ward_id" key="ward_id" label="Xã/Phường" row="grid">
                @if (!empty($supplier->district_id))
                
                    @foreach ($wards as $ward)
                        <option value={{ $ward->id }}>{{ $ward->name }}</option>
                    @endforeach 
                @endif 
            </x-form.row.select>

            <x-form.row.input wireKey="supplier.phone" key="phone" label="Điện thoại" row="grid"></x-form.row.input>

            <x-form.row.input wireKey="supplier.email" key="email" label="Email" row="grid"></x-form.row.input>

            <x-form.row.input type="url" wireKey="supplier.website" key="website" label="Website" row="grid"></x-form.row.input>

            <x-form.row.input wireKey="supplier.note" key="note" label="Ghi chú" row="grid"></x-form.row.input>
            
            <p class="text-right">
                <x-button.primary wire:click.prevent="store">{{ $submitLabel }}</x-button.primary>               
            </p>
        
        </form>
    </x-new-modal>
</div>