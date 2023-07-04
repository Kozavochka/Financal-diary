<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <form wire:submit.prevent="submitForm">
            <div>
                <label for="name">Name:</label>
                <input type="text" wire:model="name" id="name">
            </div>

            <div>
                <label for="price">Price:</label>
                <input type="text" wire:model="price" id="price">
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</div>
