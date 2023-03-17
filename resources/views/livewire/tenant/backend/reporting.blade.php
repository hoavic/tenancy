<div>
    <x-slot name="title">Báo cáo</x-slot>
    <x-slot name="header">Báo cáo</x-slot>

@livewireStyles()

    @include('tenant.backend.includes.notification')

    <div 
        x-data
    
    class="">
        <div class="setting-header">
            <button class="tab" :class="{'active' : $wire.tab === 'general'}" wire:click="setTab('general')" >Tổng quan</button>
            <button class="tab" :class="{'active' : $wire.tab === 'sales'}" wire:click="setTab('sales')" >Kinh doanh</button>
            <button class="tab" :class="{'active' : $wire.tab === 'shop'}" wire:click="setTab('shop')" >Hàng hóa</button>
            <button class="tab" :class="{'active' : $wire.tab === 'cashier'}" wire:click="setTab('cashier')" >Công nợ</button>
        </div>

        {{-- <p>{{ $tab }}</p> --}}

        @if ($tab === 'general')
            <div class="">
                <h2>Tổng quan</h2>

                <p>
                    <x-button.secondary href="#" class="btn-hover">Ngày</x-button.secondary>
                    <x-button.secondary href="#">Tuần</x-button.secondary>
                    <x-button.secondary href="#">Tháng</x-button.secondary>
                </p>

                <div class="block-setting">
                    <h3>Thông tin chung</h3>

                    <div class="setting-row">
                        <span>Loại tài khoản: </span>
                        <span>Cơ bản (<a href="#">Nâng cấp</a>)</span>
                    </div>
                    <div class="setting-row">
                        <span>Số lượng sản phẩm đã đăng: </span>
                        <span>51 / 100</span>
                    </div>
                    <div class="setting-row">
                        <span>Dung lượng đã sử dụng: </span>
                        <span>512M / 1000M</span>
                    </div>
                    <div class="setting-row">
                        <span>Ngày đến hạn: </span>
                        <span>{{ date(now()) }}</span>
                    </div>
                </div>
                
                {{-- Kho hàng --}}
                <div class="block-setting">

                    <h3>Quản lý dịch vụ khả dụng:</h3>

                    <div class="setting-row">
                        <span >Bán hàng Online: </span>
                        <div class="input-flex">
                            <input type="radio" wire:modal.prevent="online" name="online" id="online_on" value=true />
                            <label for="online_on">Bật</label>
                            <span>-</span>
                            <input type="radio" wire:modal.prevent="online" name="online" id="online_off" value=false />
                            <label for="online_off">Tắt</label>
                        </div>
                    </div>

                    <div class="setting-row">
                        <span >Bán hàng Offline: </span>
                        <div class="input-flex">
                            <input type="radio" wire:modal.prevent="offline" name="offline" id="offline_on" value=true />
                            <label for="offline_on">Bật</label>
                            <span>-</span>
                            <input type="radio" wire:modal.prevent="offline" name="offline" id="offline_off" value=false />
                            <label for="offline_off">Tắt</label>
                        </div>
                    </div>

                    <div class="setting-row">
                        <span >Phần mềm tính tiền: </span>
                        <div class="input-flex">
                            <input type="radio" wire:modal.prevent="cashier" name="cashier" id="cashier_on" value=true />
                            <label for="cashier_on">Bật</label>
                            <span>-</span>
                            <input type="radio" wire:modal.prevent="cashier" name="cashier" id="cashier_off" value=false />
                            <label for="cashier_off">Tắt</label>
                        </div>
                    </div>

                    <div class="setting-row">
                        <span >Quản lý tồn kho: </span>
                        <div class="input-flex">
                            <input type="radio" wire:modal.prevent="warehouse" name="warehouse" id="warehouse_on" value=true />
                            <label for="warehouse_on">Bật</label>
                            <span>-</span>
                            <input type="radio" wire:modal.prevent="warehouse" name="warehouse" id="warehouse_off" value=false />
                            <label for="warehouse_off">Tắt</label>
                        </div>
                    </div>
                </div>

                {{-- Website --}}
                <div class="block-setting">
                    <h3>Thông tin chung:</h3>
                    <div class="setting-row">
                        <label for="company">Tên doanh nghiệp: </label>
                        <input type="text" wire:modal.prevent="company" name="company" id="company" />
                    </div>
                    <div class="setting-row">
                        <label for="brand">Tên thương hiệu: </label>
                        <input type="text" wire:modal.prevent="brand" name="brand" id="brand" />
                    </div>
                    <div class="setting-row">
                        <label for="address">Địa chỉ: </label>
                        <input type="text" wire:modal.prevent="address" name="address" id="address" />
                    </div>
                    <div class="setting-row">
                        <label for="email">Email: </label>
                        <input type="text" wire:modal.prevent="email" name="email" id="email" />
                    </div>
                    <div class="setting-row">
                        <label for="phone">Điện thoại: </label>
                        <input type="text" wire:modal.prevent="phone" name="phone" id="phone" />
                    </div>
                </div>

            <p><x-button.primary>Cập nhật</x-button.primary></p>

            </div>
        @endif

        @if ($tab === 'website')
            <div class="">
                <h2>Cài đặt Website</h2>

                <p>
                    <x-button.secondary href="#">Giao diện</x-button.secondary>
                    <x-button.secondary href="#">Plugin</x-button.secondary>
                    <x-button.secondary href="#">Cache</x-button.secondary>
                </p>

                <div class="block-setting">
                    <h3>Thông tin chung</h3>

                    <div class="setting-row">
                        <span>Gói đang sử dụng: </span>
                        <span>Cơ bản</span>
                    </div>
                    <div class="setting-row">
                        <span>Dung lượng đã sử dụng: </span>
                        <span>512M / 1000M</span>
                    </div>
                    <div class="setting-row">
                        <span>Băng thông đã sử dụng: </span>
                        <span>30G / 100G</span>
                    </div>
                    <div class="setting-row">
                        <span>Ngày hết hạn: </span>
                        <span>{{ date(now()) }}</span>
                    </div>
                </div>

                <div class="block-setting">
                    <h3>Cài đặt tổng quan</h3>

                    <div class="setting-row">
                        <label for="name">Tiêu đề Website: </label>
                        <input type="text" wire:modal.prevent="web.name" name="name" id="name" />
                    </div>
                    <div class="setting-row">
                        <label for="domain">Cài đặt tên miền: </label>
                        <input type="text" wire:modal.prevent="web.domain" name="domain" id="domain" />
                    </div>
                </div>

                <p><x-button.primary>Cập nhật</x-button.primary></p>

            </div>
        @endif

    </div>
@livewireScripts()
</div>
