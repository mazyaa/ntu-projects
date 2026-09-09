{{-- Step 3: Data Objek K3 (Dynamic) --}}
<h2 class="text-lg font-bold text-[#06205E] mb-6">Data Objek K3</h2>

<div x-data="objectManager()" x-init="init()">
    {{-- Object Cards --}}
    <template x-for="(obj, index) in objects" :key="obj.id || index">
        <div class="relative border border-gray-200 rounded-xl p-5 mb-4 bg-gray-50/40 hover:bg-gray-50 transition-all">
            {{-- Remove Button --}}
            <button type="button" x-show="objects.length > 1"
                @click="removeObject(index)"
                class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition-colors p-1 rounded-lg hover:bg-red-50">
                <svg data-lucide="trash-2" class="w-4 h-4"></svg>
            </button>

            <p class="text-sm font-semibold text-[#0736AA] mb-4">Objek <span x-text="index + 1"></span></p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Jenis Objek K3 --}}
                <div>
                    <label class="block text-sm font-semibold text-[#06205E] mb-1.5">Jenis Objek K3 <span class="text-red-500">*</span></label>
                    <select :name="'objects[' + index + '][category_id]'"
                        x-model="obj.category_id"
                        @change="loadTypes(index)"
                        required
                        class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Jenis Spesifik --}}
                <div>
                    <label class="block text-sm font-semibold text-[#06205E] mb-1.5">Jenis Spesifik</label>
                    <select :name="'objects[' + index + '][type_id]'"
                        x-model="obj.type_id"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4">
                        <option value="">Pilih Jenis Spesifik</option>
                        <template x-for="type in obj.types" :key="type.id">
                            <option :value="type.id" x-text="type.name"></option>
                        </template>
                    </select>
                </div>

                {{-- Nama Objek --}}
                <div>
                    <label class="block text-sm font-semibold text-[#06205E] mb-1.5">Nama Objek <span class="text-red-500">*</span></label>
                    <input type="text" :name="'objects[' + index + '][object_name]'"
                        x-model="obj.object_name" required
                        class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                        placeholder="Contoh: Crane Mobile">
                </div>

                {{-- Merek/Brand --}}
                <div>
                    <label class="block text-sm font-semibold text-[#06205E] mb-1.5">Merek / Brand</label>
                    <input type="text" :name="'objects[' + index + '][brand]'"
                        x-model="obj.brand"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                        placeholder="Contoh: Liebherr">
                </div>

                {{-- Tipe/Model --}}
                <div>
                    <label class="block text-sm font-semibold text-[#06205E] mb-1.5">Tipe / Model</label>
                    <input type="text" :name="'objects[' + index + '][model]'"
                        x-model="obj.model"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                        placeholder="Contoh: LTM 1100">
                </div>

                {{-- Nomor Seri --}}
                <div>
                    <label class="block text-sm font-semibold text-[#06205E] mb-1.5">Nomor Seri</label>
                    <input type="text" :name="'objects[' + index + '][serial_number]'"
                        x-model="obj.serial_number"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                        placeholder="Nomor seri peralatan">
                </div>

                {{-- Nomor Pabrik --}}
                <div>
                    <label class="block text-sm font-semibold text-[#06205E] mb-1.5">Nomor Pabrik</label>
                    <input type="text" :name="'objects[' + index + '][factory_number]'"
                        x-model="obj.factory_number"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                        placeholder="Nomor pabrik">
                </div>

                {{-- Tahun Pembuatan --}}
                <div>
                    <label class="block text-sm font-semibold text-[#06205E] mb-1.5">Tahun Pembuatan</label>
                    <input type="text" :name="'objects[' + index + '][manufacture_year]'"
                        x-model="obj.manufacture_year"
                        maxlength="4" pattern="\d{4}"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                        placeholder="Contoh: 2020">
                </div>

                {{-- Kapasitas --}}
                <div>
                    <label class="block text-sm font-semibold text-[#06205E] mb-1.5">Kapasitas</label>
                    <input type="text" :name="'objects[' + index + '][capacity]'"
                        x-model="obj.capacity"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                        placeholder="Contoh: 10">
                </div>

                {{-- Satuan Kapasitas --}}
                <div>
                    <label class="block text-sm font-semibold text-[#06205E] mb-1.5">Satuan Kapasitas</label>
                    <input type="text" :name="'objects[' + index + '][capacity_unit]'"
                        x-model="obj.capacity_unit"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                        placeholder="Contoh: ton">
                </div>
            </div>
        </div>
    </template>

    {{-- Add Object Button --}}
    <button type="button" @click="addObject()"
        class="w-full border-2 border-dashed border-[#0736AA]/30 rounded-xl py-3 text-[#0736AA] hover:bg-[#0736AA]/5 hover:border-[#0736AA]/50 transition-all text-sm font-semibold flex items-center justify-center gap-2">
        <svg data-lucide="plus" class="w-4 h-4"></svg>
        Tambah Objek
    </button>
</div>

<script>
function objectManager() {
    return {
        objects: {!! json_encode($draft['objects'] ?? [['category_id' => '', 'type_id' => '', 'object_name' => '', 'brand' => '', 'model' => '', 'serial_number' => '', 'factory_number' => '', 'manufacture_year' => '', 'capacity' => '', 'capacity_unit' => '', 'types' => []]]) !!},

        init() {
            this.objects.forEach((obj, i) => {
                if (obj.category_id) this.loadTypes(i);
            });
            this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        },

        async loadTypes(index) {
            const obj = this.objects[index];
            if (!obj.category_id) { obj.types = []; obj.type_id = ''; return; }
            try {
                const resp = await fetch('{{ route("customer.requests.types") }}?category_id=' + obj.category_id);
                const data = await resp.json();
                obj.types = data || [];
                obj.type_id = '';
            } catch (e) { console.error(e); }
        },

        async addObject() {
            try {
                const resp = await fetch('{{ route("customer.requests.addObject") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const data = await resp.json();
                this.objects.push(data.object || {
                    category_id: '', type_id: '', object_name: '', brand: '', model: '',
                    serial_number: '', factory_number: '', manufacture_year: '', capacity: '',
                    capacity_unit: '', types: []
                });
                this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
            } catch (e) {
                this.objects.push({
                    category_id: '', type_id: '', object_name: '', brand: '', model: '',
                    serial_number: '', factory_number: '', manufacture_year: '', capacity: '',
                    capacity_unit: '', types: []
                });
                this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
            }
        },

        async removeObject(index) {
            if (this.objects.length <= 1) return;
            const obj = this.objects[index];
            if (obj.id) {
                try {
                    await fetch('{{ route("customer.requests.removeObject", ":index") }}'.replace(':index', index), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                } catch (e) { console.error(e); }
            }
            this.objects.splice(index, 1);
        }
    };
}
</script>
