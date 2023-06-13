<form class="w-50 mt-5 mx-auto d-flex" wire:submit.prevent='submit'>
    <input wire:model.defer='todoText' class="form-control" type="text" placeholder="Add todo" aria-label="add todo">
    <button type="button" class="btn btn-secondary w-25" wire:click='submit'>Add todo</button>
</form>
