<div class="top-action">
    <form class="top-action__form">

        <x-form.row.select wireKey="perPage" key="perPage" >
            <option value=5>5</option>
            <option value=10>10</option>
            <option value=20>20</option>
            <option value=50>50</option>
        </x-form.row.select>

        <x-form.row.select wireKey="actionType" key="actionType" >
            <option>Hành động</option>
            <option value="delete">Xóa</option>
        </x-form.row.select>
        <x-button.secondary wire:click.prevent="topAction()" type="submit">Áp dụng</x-button.secondary>
    </form>
    
    <div class="form-row">
        <label for="searchPagi">Tìm kiếm</label>
        <input type="text" wire:model="searchPagi" id="searchPagi" name="searchPagi">
    </div>

    <x-button.primary wire:click.prevent="create">Thêm</x-button.primary>

</div>

