<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">🛒 Keranjang Belanja</h1>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(count($keranjang) > 0)
            <table class="w-full bg-white rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Nama Produk</th>
                        <th class="p-3 text-center">Harga</th>
                        <th class="p-3 text-center">Jumlah</th>
                        <th class="p-3 text-center">Subtotal</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keranjang as $id => $item)
                    <tr class="border-t">
                        <td class="p-3">{{ $item['nama'] }}</td>
                        <td class="p-3 text-center">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>

                        {{-- Form Update Jumlah --}}
                        <td class="p-3 text-center">
                            <form action="{{ route('Keranjang.update', $id) }}" method="POST" class="flex items-center justify-center gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="jumlah" value="{{ $item['jumlah'] }}"
                                    min="1" class="w-16 border rounded px-2 py-1 text-center">
                                <button type="submit"
                                    class="bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600">
                                    Update
                                </button>
                            </form>
                        </td>

                        <td class="p-3 text-center">
                            Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}
                        </td>

                        {{-- Form Hapus --}}
                        <td class="p-3 text-center">
                            <form action="{{ route('Keranjang.destroy', $id) }}" method="POST"
                                onsubmit="return confirm('Hapus item ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t bg-gray-50">
                        <td colspan="3" class="p-3 text-right font-bold">Total:</td>
                        <td class="p-3 text-center font-bold text-green-600">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('menu.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    ← Lanjut Belanja
                </a>
                <a href="#" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Checkout →
                </a>
            </div>

        @else
            <div class="text-center py-16 text-gray-500">
                <p class="text-5xl mb-4">🛒</p>
                <p class="text-lg">Keranjang kamu masih kosong.</p>
                <a href="{{ route('menu.index') }}"
                   class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Lihat Menu
                </a>
            </div>
        @endif
    </div>
</x-app-layout>