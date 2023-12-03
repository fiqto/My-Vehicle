<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="flex items-center justify-between mb-4">
                <p class="text-2xl font-medium text-gray-700 dark:text-gray-500">
                    Daftar Persetujuan
                </p>
            </div>
            
            <div class="relative min-h-48 mb-4 sm:rounded-lg overflow-x-auto shadow-md bg-white dark:bg-gray-800">
                <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Kendaraan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sopir
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Alasan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Mulai Pinjam
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Akhir Pinjam
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $approvals as $approval )
                            <tr class="bg-gray-50 border-b  dark:bg-gray-800 dark:border-gray-700 hover:bg-white dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ $approval->booking->vehicle->plat_no }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $approval->booking->driver->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $approval->booking->reason }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $approval->booking->start_date->toDateString() }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $approval->booking->end_date->toDateString() }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $approval->status }}
                                </td>
                                <td class="flex items-center px-6 py-4 gap-2">
                                    @if ($approval->status === "Menunggu")
                                        <button data-modal-target="edit-modal{{ $approval->id }}" data-modal-toggle="edit-modal{{ $approval->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" type="button">
                                            Edit
                                        </button>
                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="m-4">
                    {{ $approvals->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @foreach ( $approvals as $approval )
    <div id="edit-modal{{ $approval->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Ubah Persetujuan
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal{{ $approval->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('approvals.update', $approval->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="Setuju" {{ old('status', $approval->status) === 'Setuju' ? 'selected' : '' }}>Setuju</option>
                                <option value="Tidak Setuju" {{ old('status', $approval->status) === 'Tidak Setuju' ? 'selected' : '' }}>Tidak Setuju</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

</x-app-layout>
