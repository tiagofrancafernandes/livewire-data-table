<tr @if($edit) class="bg-green-300" @endif>
    <td class="border px-4 py-2">{{ $user->id }}</td>

    @if($edit)
    <td class="border px-4 py-2">
        <input 
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            type="text" 
            placeholder="User name"
            value="{{ $user->name }}"
            wire:model.debounce.500ms="name"
            wire:keydown.enter="saveEditedUser"
            wire:keydown.escape="cancelEditUser"
        >
        @error('name') <i class="text-red-600 text-xs font-semibold">{{ $message }}</i> @enderror
    </td>
    @else
    <td class="border px-4 py-2">{{ $user->name }}</td>
    @endif

    @if($edit)
    <td class="border px-4 py-2">
        <input 
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            type="text" 
            placeholder="User email"
            value="{{ $user->email }}"
            wire:model.debounce.500ms="email"
            wire:keydown.enter="saveEditedUser"
            wire:keydown.escape="cancelEditUser"
        >
        @error('email') <i class="text-red-600 text-xs font-semibold">{{ $message }}</i> @enderror
    </td>
    @else
    <td class="border px-4 py-2">{{ $user->email }}</td>
    @endif

    <td class="border px-4 py-2">{{ $user->created_at->diffForHumans() }}</td>
    <td class="border px-4 py-2 w-1/6">
        @if($edit)
        <button 
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded-lg focus:outline-none focus:ring focus:border-green-300"
            wire:click="saveEditedUser"
        >
            Save
        </button>
        <button 
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-lg focus:outline-none focus:ring focus:border-red-300"
            wire:click="cancelEditUser"
        >
            Cancel
        </button>
        @else
        <button 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-lg focus:outline-none focus:ring focus:border-blue-300"
            wire:click="editUser"
        >
            Edit
        </button>
        @endif
    </td>
</tr>